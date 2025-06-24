<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use Str;

class SubCategoryController extends Controller
{
    public function index(){
        $data['subCategories'] = SubCategory::latest()->get();
        return view('pages.sub-category.index' ,$data);
    }

    public function edit($slug){
        $data['subCategory'] = SubCategory::where('slug', $slug)->firstorfail();
        $data['categories'] = Category::get();
        return view('pages.sub-category.edit' ,$data);
    }

    public function update(Request $request, $id){
        // Validation rules
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|max:255|unique:sub_categories,name,'.$id,
            'title' => 'required|max:255',
            'description' => 'nullable',
            'fields_key' => 'nullable|array',
            'fields_key.*' => 'in:radio,checkbox,input,select',
            'fields_value' => 'nullable|string',
            'status' => 'required|in:0,1',
        ]);

        // Generate unique slug
        $slug = Str::slug($request->name, '-');
        $originalSlug = $slug;
        $counter = 1;

        // Check for unique slug excluding current record
        while (SubCategory::where('slug', $slug)->where('id', '!=', $id)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        // Process fields_value JSON if provided
        $fieldsValue = null;
        if ($request->fields_value) {
            $fieldsValue = json_decode($request->fields_value, true);

            // Validate the JSON structure
            if (json_last_error() !== JSON_ERROR_NONE) {
                return back()
                    ->withErrors(['fields_value' => 'Invalid field configuration data.'])
                    ->withInput();
            }

            // Additional validation for fields_value structure
            if (is_array($fieldsValue) && $request->fields_key) {
                foreach ($fieldsValue as $fieldType => $fieldConfig) {
                    // Validate that each field type exists in fields_key
                    if (!in_array($fieldType, $request->fields_key)) {
                        return back()
                            ->withErrors(['fields_value' => "Field type '{$fieldType}' not selected in field types."])
                            ->withInput();
                    }

                    // Validate field configuration structure
                    if (!is_array($fieldConfig) || !isset($fieldConfig['values'])) {
                        return back()
                            ->withErrors(['fields_value' => "Invalid configuration for field type '{$fieldType}'."])
                            ->withInput();
                    }

                    // Validate that required field types have values
                    if (in_array($fieldType, ['radio', 'checkbox', 'select'])) {
                        $hasValidValues = false;
                        if (is_array($fieldConfig['values'])) {
                            foreach ($fieldConfig['values'] as $value) {
                                if (!empty(trim($value))) {
                                    $hasValidValues = true;
                                    break;
                                }
                            }
                        }
                        if (!$hasValidValues) {
                            return back()
                                ->withErrors(['fields_value' => "At least one option required for {$fieldType} field."])
                                ->withInput();
                        }
                    }
                }
            }
        }

        try {
            // Update the sub-category
            $subCategory = SubCategory::where('id', $id)->update([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'slug' => $slug,
                'title' => $request->title,
                'description' => $request->description,
                'fields_key' => $request->fields_key ? json_encode($request->fields_key) : null,
                'fields_value' => $fieldsValue ? json_encode($fieldsValue) : null,
                'status' => $request->status,
            ]);

            return redirect()
                ->route('sub-category.index')
                ->with('success', 'Sub Category updated successfully.');

        } catch (\Exception $e) {
            return back()
                ->withErrors(['error' => 'Failed to update sub-category. Please try again.'])
                ->withInput();
        }
    }

    /**
     * Helper method to get configured fields for frontend display
     */
    public function getFieldConfiguration($subCategoryId)
    {
        $subCategory = SubCategory::findOrFail($subCategoryId);

        // Get the configured fields
        $fieldsKey = is_string($subCategory->fields_key)
            ? json_decode($subCategory->fields_key, true)
            : $subCategory->fields_key ?? [];

        $fieldsValue = is_string($subCategory->fields_value)
            ? json_decode($subCategory->fields_value, true)
            : $subCategory->fields_value ?? [];

        $formFields = [];

        foreach ($fieldsKey as $fieldType) {
            if (isset($fieldsValue[$fieldType])) {
                $fieldConfig = $fieldsValue[$fieldType];
                $formFields[] = [
                    'type' => $fieldType,
                    'label' => $fieldConfig['label'] ?? ucfirst($fieldType) . ' Field',
                    'values' => $fieldConfig['values'] ?? [],
                    'name' => 'field_' . $fieldType,
                    'required' => $fieldConfig['required'] ?? false,
                ];
            }
        }

        return $formFields;
    }

    /**
     * Preview configured fields via AJAX
     */
    public function previewFields(Request $request)
    {
        $fieldsKey = $request->fields_key ?? [];
        $fieldsValue = $request->fields_value ? json_decode($request->fields_value, true) : [];

        $preview = [];

        foreach ($fieldsKey as $fieldType) {
            if (isset($fieldsValue[$fieldType])) {
                $fieldConfig = $fieldsValue[$fieldType];
                $preview[] = [
                    'type' => $fieldType,
                    'label' => $fieldConfig['label'] ?? ucfirst($fieldType) . ' Field',
                    'values' => $fieldConfig['values'] ?? [],
                ];
            }
        }

        return response()->json([
            'success' => true,
            'preview' => $preview
        ]);
    }

    /**
     * Validate field configuration via AJAX
     */
    public function validateFieldConfiguration(Request $request)
    {
        $fieldsKey = $request->fields_key ?? [];
        $fieldsValue = $request->fields_value ? json_decode($request->fields_value, true) : [];

        $errors = [];

        // Check if fields_value JSON is valid
        if ($request->fields_value && json_last_error() !== JSON_ERROR_NONE) {
            $errors[] = 'Invalid field configuration format.';
        }

        // Validate each field type
        foreach ($fieldsKey as $fieldType) {
            if (!isset($fieldsValue[$fieldType])) {
                $errors[] = "Configuration missing for field type: {$fieldType}";
                continue;
            }

            $fieldConfig = $fieldsValue[$fieldType];

            // Check if values are provided for fields that need them
            if (in_array($fieldType, ['radio', 'checkbox', 'select'])) {
                if (empty($fieldConfig['values']) || !is_array($fieldConfig['values'])) {
                    $errors[] = "Options/values required for {$fieldType} field.";
                } else {
                    // Check if values are not empty
                    $hasValidValues = false;
                    foreach ($fieldConfig['values'] as $value) {
                        if (!empty(trim($value))) {
                            $hasValidValues = true;
                            break;
                        }
                    }
                    if (!$hasValidValues) {
                        $errors[] = "At least one valid option required for {$fieldType} field.";
                    }
                }
            }
        }

        return response()->json([
            'valid' => empty($errors),
            'errors' => $errors
        ]);
    }
}
