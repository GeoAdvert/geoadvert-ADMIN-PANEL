<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Plan;
use App\Models\PlanItem;
use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StructureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createTailoredPackagesCategory();
        $this->createCustomPackagesCategory();
        $this->createExpertConsultationCategory();
    }

    /**
     * Create the "Tailored packages for your industry" category with all subcategories
     */
    private function createTailoredPackagesCategory(): void
    {
        $category = Category::create([
            'name' => 'Tailored packages for your industry',
            'slug' => 'tailored-packages-for-your-industry',
            'description' => 'Designed with the needs of specific companies in mind',
            'status' => true,
        ]);

        $this->createIndustrySubcategories($category);
    }

    /**
     * Create industry-specific subcategories and their plans
     */
    private function createIndustrySubcategories(Category $category): void
    {
        $industries = [
            'gastronomy' => [
                'name' => 'Gastronomy industry',
                'description' => 'Many of our clients in the gastronomy industry face the same challenge - attracting customers at selected times of day, and building brand awareness.',
                'plans' => $this->getGastronomyPlans()
            ],
            'beauty-lifestyle' => [
                'name' => 'Beauty and lifestyle',
                'description' => 'Many of our clients in the beauty and lifestyle industry face the same challenge - attracting customers at selected times of day, and building brand awareness.',
                'plans' => $this->getBeautyLifestylePlans()
            ],
            'technology-digital' => [
                'name' => 'Technology and digital',
                'description' => 'Many of our technology clients face the same challenge - reaching their target audience in the competitive digital landscape.',
                'plans' => $this->getTechnologyPlans()
            ],
            'culture-entertainment' => [
                'name' => 'Culture and entertainment',
                'description' => 'Music clubs, cocktail bars, themed parties, evening meeting places. In this industry, timing and audience targeting are crucial.',
                'plans' => $this->getCultureEntertainmentPlans()
            ],
            'finance-institutions' => [
                'name' => 'Finance and institutions',
                'description' => 'Financial services and institutions require trust-building campaigns with targeted professional audiences.',
                'plans' => $this->getFinancePlans()
            ],
            'health-medicine' => [
                'name' => 'Health and medicine',
                'description' => 'Healthcare providers need to reach patients with trust-building, informative campaigns.',
                'plans' => []
            ],
            'sports-recreation' => [
                'name' => 'Sports and recreation',
                'description' => 'Sports facilities and recreation centers need to attract active lifestyle enthusiasts.',
                'plans' => []
            ],
            'education-development' => [
                'name' => 'Education and development',
                'description' => 'Educational institutions and training providers need to reach students and professionals.',
                'plans' => []
            ],
        ];

        foreach ($industries as $slug => $data) {
            $subCategory = SubCategory::create([
                'category_id' => $category->id,
                'name' => $data['name'],
                'slug' => $slug,
                'title' => 'Purchase a subscription',
                'description' => $data['description'],
                'status' => true,
            ]);

            if (!empty($data['plans'])) {
                $this->createPlansWithItems($subCategory, $data['plans']);
            }
        }
    }

    /**
     * Create "Choose the package yourself" category
     */
    private function createCustomPackagesCategory(): void
    {
        $category = Category::create([
            'name' => 'Choose the package yourself',
            'slug' => 'choose-the-package-yourself',
            'description' => 'For companies that know what they want - choose only what you need and tailor the campaign to your budget.',
            'status' => true,
        ]);

        $customSubcategories = [
            'standard-advertising' => [
                'name' => 'Standard Advertising',
                'description' => 'Basic advertising solutions for businesses of all sizes.',
                'plans' => $this->getStandardAdvertisingPlans()
            ],
            'video-advertising' => [
                'name' => 'Video Advertising',
                'description' => 'Engaging video content to capture audience attention.',
                'plans' => $this->getVideoAdvertisingPlans()
            ],
            'geolocation-advertising' => [
                'name' => 'Geolocation Advertising',
                'description' => 'Target customers based on their geographic location.',
                'plans' => []
            ],
            'hourly-advertising' => [
                'name' => 'Advertising at specific hours',
                'description' => 'Reach your audience at the most effective times of day.',
                'plans' => []
            ],
            'personalized-advertising' => [
                'name' => 'Personalized advertising',
                'description' => 'Customized campaigns based on user behavior and preferences.',
                'plans' => []
            ],
            'custom-views' => [
                'name' => 'Choose the number of views yourself',
                'description' => 'Flexible packages where you decide the exact number of views.',
                'plans' => []
            ],
        ];

        foreach ($customSubcategories as $slug => $data) {
            $subCategory = SubCategory::create([
                'category_id' => $category->id,
                'name' => $data['name'],
                'slug' => $slug,
                'title' => 'Purchase a subscription',
                'description' => $data['description'],
                'status' => true,
            ]);

            if (!empty($data['plans'])) {
                $this->createPlansWithItems($subCategory, $data['plans']);
            }
        }
    }

    /**
     * Create "Choose a solution with an expert" category
     */
    private function createExpertConsultationCategory(): void
    {
        Category::create([
            'name' => 'Choose a solution with an expert',
            'slug' => 'choose-a-solution-with-an-expert',
            'description' => "Need help choosing the right option? In a short conversation, we'll help you choose the option that best suits your goals.",
            'status' => true,
        ]);
    }

    /**
     * Get gastronomy industry plans
     */
    private function getGastronomyPlans(): array
    {
        return [
            [
                'title' => 'Starter Package',
                'slug' => 'gastronomy-starter',
                'original_price' => 740,
                'items' => [
                    ['description' => 'Perfect for microenterprises, local businesses, and test campaigns.', 'reward' => 'Local reach'],
                    ['description' => '50,000 standard views', 'reward' => 50000],
                    ['description' => 'Basic targeting options', 'reward' => 'Basic targeting'],
                ]
            ],
            [
                'title' => 'Standard Package',
                'slug' => 'gastronomy-standard',
                'original_price' => 1244,
                'items' => [
                    ['description' => 'Ideal for growing restaurants and local food chains.', 'reward' => 'Regional reach'],
                    ['description' => '125,000 standard views', 'reward' => 125000],
                    ['description' => '40,000 hourly targeted views', 'reward' => 40000],
                    ['description' => '2,000 geolocation views', 'reward' => 2000],
                ]
            ],
            [
                'title' => 'Professional Package',
                'slug' => 'gastronomy-professional',
                'original_price' => 1802,
                'items' => [
                    ['description' => 'Perfect for established restaurants and intensive campaigns.', 'reward' => 'Professional marketing'],
                    ['description' => '210,000 standard views', 'reward' => 210000],
                    ['description' => '60,000 hourly targeted views', 'reward' => 60000],
                    ['description' => '3,000 geolocation views', 'reward' => 3000],
                ]
            ],
            [
                'title' => 'Premium Package',
                'slug' => 'gastronomy-premium',
                'original_price' => 2804,
                'items' => [
                    ['description' => 'Maximum exposure for large food chains and major campaigns.', 'reward' => 'Maximum exposure'],
                    ['description' => '500,000 standard views', 'reward' => 500000],
                    ['description' => 'Premium placement and advanced targeting', 'reward' => 'Premium features'],
                    ['description' => 'Cost: PLN 5.61 per 1,000 views', 'reward' => 'Cost-effective'],
                ]
            ],
        ];
    }

    /**
     * Get beauty and lifestyle plans
     */
    private function getBeautyLifestylePlans(): array
    {
        return [
            [
                'title' => 'Starter Package',
                'slug' => 'beauty-starter',
                'original_price' => 740,
                'items' => [
                    ['description' => 'Perfect for beauty salons, wellness centers, and local businesses.', 'reward' => 'Local presence'],
                    ['description' => '50,000 standard views', 'reward' => 50000],
                ]
            ],
            [
                'title' => 'Standard Package',
                'slug' => 'beauty-standard',
                'original_price' => 1244,
                'items' => [
                    ['description' => 'Ideal for established salons and growing beauty brands.', 'reward' => 'Brand growth'],
                    ['description' => '125,000 standard views', 'reward' => 125000],
                    ['description' => '40,000 hourly targeted views', 'reward' => 40000],
                    ['description' => '2,000 geolocation views', 'reward' => 2000],
                ]
            ],
            [
                'title' => 'Ultra Package',
                'slug' => 'beauty-ultra',
                'original_price' => 2804,
                'items' => [
                    ['description' => 'Maximum scale and reach for large beauty chains and lifestyle brands.', 'reward' => 'Market leadership'],
                    ['description' => '500,000 premium views', 'reward' => 500000],
                    ['description' => 'Advanced targeting and premium placements', 'reward' => 'Premium targeting'],
                    ['description' => 'Perfect for multi-location operators and service networks', 'reward' => 'Multi-location support'],
                ]
            ],
        ];
    }

    /**
     * Get technology and digital plans
     */
    private function getTechnologyPlans(): array
    {
        return [
            [
                'title' => 'Standard Package',
                'slug' => 'tech-standard',
                'original_price' => 740,
                'items' => [
                    ['description' => 'Perfect for tech startups and digital service providers.', 'reward' => 'Tech startup focus'],
                    ['description' => '100,000 targeted views', 'reward' => 100000],
                ]
            ],
            [
                'title' => 'Premium Package',
                'slug' => 'tech-premium',
                'original_price' => 1572,
                'items' => [
                    ['description' => 'Ideal for growing tech companies and software providers.', 'reward' => 'Professional tech marketing'],
                    ['description' => '250,000 highly targeted views', 'reward' => 250000],
                    ['description' => 'Advanced digital audience targeting', 'reward' => 'Advanced targeting'],
                ]
            ],
            [
                'title' => 'Ultra Package',
                'slug' => 'tech-ultra',
                'original_price' => 2804,
                'items' => [
                    ['description' => 'Maximum reach for enterprise tech solutions and platforms.', 'reward' => 'Enterprise reach'],
                    ['description' => '500,000 premium views', 'reward' => 500000],
                    ['description' => 'Cost: PLN 5.60 per 1,000 views', 'reward' => 'Enterprise pricing'],
                ]
            ],
        ];
    }

    /**
     * Get culture and entertainment plans
     */
    private function getCultureEntertainmentPlans(): array
    {
        return [
            [
                'title' => 'Start Package',
                'slug' => 'culture-start',
                'original_price' => 330,
                'items' => [
                    ['description' => 'Perfect for local venues and small events.', 'reward' => 'Local events'],
                    ['description' => '30,000 standard views', 'reward' => 30000],
                    ['description' => '1,000 geolocation views', 'reward' => 1000],
                ]
            ],
            [
                'title' => 'Standard Package',
                'slug' => 'culture-standard',
                'original_price' => 844,
                'items' => [
                    ['description' => 'Ideal for established venues and regular events.', 'reward' => 'Regular promotion'],
                    ['description' => '80,000 standard views', 'reward' => 80000],
                    ['description' => '3,000 geolocation views', 'reward' => 3000],
                ]
            ],
            [
                'title' => 'Premium Package',
                'slug' => 'culture-premium',
                'original_price' => 1404,
                'items' => [
                    ['description' => 'Perfect for major venues and large-scale events.', 'reward' => 'Major events'],
                    ['description' => '80,000 standard views', 'reward' => 80000],
                    ['description' => '80,000 hourly targeted views', 'reward' => 80000],
                    ['description' => '3,000 geolocation views', 'reward' => 3000],
                ]
            ],
            [
                'title' => 'Ultra Package',
                'slug' => 'culture-ultra',
                'original_price' => 2800,
                'items' => [
                    ['description' => 'Maximum exposure for festivals and major cultural events.', 'reward' => 'Festival scale'],
                    ['description' => '500,000 views with full promotion', 'reward' => 500000],
                    ['description' => 'Premium event marketing features', 'reward' => 'Premium events'],
                ]
            ],
        ];
    }

    /**
     * Get finance and institutions plans
     */
    private function getFinancePlans(): array
    {
        return [
            [
                'title' => 'Start Package',
                'slug' => 'finance-start',
                'original_price' => 240,
                'items' => [
                    ['description' => 'Perfect for small financial advisors and local services.', 'reward' => 'Local financial services'],
                    ['description' => '25,000 targeted views', 'reward' => 25000],
                ]
            ],
            [
                'title' => 'Standard Package',
                'slug' => 'finance-standard',
                'original_price' => 744,
                'items' => [
                    ['description' => 'Ideal for financial institutions and professional services.', 'reward' => 'Professional finance'],
                    ['description' => '100,000 targeted views', 'reward' => 100000],
                    ['description' => 'Professional audience targeting', 'reward' => 'Professional targeting'],
                ]
            ],
            [
                'title' => 'Premium Package',
                'slug' => 'finance-premium',
                'original_price' => 1582,
                'items' => [
                    ['description' => 'Perfect for large financial institutions and investment firms.', 'reward' => 'Enterprise finance'],
                    ['description' => '250,000 highly targeted views', 'reward' => 250000],
                    ['description' => 'Advanced professional targeting', 'reward' => 'Advanced targeting'],
                    ['description' => 'Premium placement on financial platforms', 'reward' => 'Premium placement'],
                ]
            ],
            [
                'title' => 'Ultra Package',
                'slug' => 'finance-ultra',
                'original_price' => 2804,
                'items' => [
                    ['description' => 'Maximum reach for major financial institutions and banks.', 'reward' => 'Banking scale'],
                    ['description' => '500,000 premium targeted views', 'reward' => 500000],
                    ['description' => 'Enterprise-level targeting and analytics', 'reward' => 'Enterprise features'],
                ]
            ],
        ];
    }

    /**
     * Get standard advertising plans
     */
    private function getStandardAdvertisingPlans(): array
    {
        return [
            [
                'title' => 'Start Package',
                'slug' => 'standard-start',
                'original_price' => 250,
                'items' => [
                    ['description' => 'Perfect for microenterprises and local businesses starting their advertising journey.', 'reward' => 'Business starter'],
                    ['description' => '25,000 views (PLN 10 per 1,000 views)', 'reward' => 25000],
                    ['description' => 'Basic targeting options', 'reward' => 'Basic features'],
                ]
            ],
            [
                'title' => 'Standard Package',
                'slug' => 'standard-standard',
                'original_price' => 750,
                'items' => [
                    ['description' => 'Ideal for local businesses, restaurants, and shops wanting to reach more customers.', 'reward' => 'Local expansion'],
                    ['description' => '100,000 views (PLN 7.50 per 1,000 views)', 'reward' => 100000],
                    ['description' => 'Enhanced targeting and city-wide reach', 'reward' => 'City reach'],
                ]
            ],
            [
                'title' => 'Premium Package',
                'slug' => 'standard-premium',
                'original_price' => 1600,
                'items' => [
                    ['description' => 'Perfect for brands wanting to increase awareness and conduct broader campaigns.', 'reward' => 'Brand awareness'],
                    ['description' => 'Ideal for medical clinics and beauty salons', 'reward' => 'Professional services'],
                    ['description' => '250,000 views (PLN 6.40 per 1,000 views)', 'reward' => 250000],
                    ['description' => 'Advanced targeting and analytics', 'reward' => 'Advanced features'],
                ]
            ],
        ];
    }

    /**
     * Get video advertising plans
     */
    private function getVideoAdvertisingPlans(): array
    {
        return [
            [
                'title' => 'Start Package',
                'slug' => 'video-start',
                'original_price' => 375,
                'items' => [
                    ['description' => 'Perfect for testing video advertising effectiveness.', 'reward' => 'Video testing'],
                    ['description' => '25,000 video views', 'reward' => 25000],
                    ['description' => 'Basic video placement options', 'reward' => 'Basic video'],
                ]
            ],
            [
                'title' => 'Standard Package',
                'slug' => 'video-standard',
                'original_price' => 1125,
                'items' => [
                    ['description' => 'Ideal for businesses ready to invest in video marketing.', 'reward' => 'Video marketing'],
                    ['description' => '100,000 video views', 'reward' => 100000],
                    ['description' => 'Enhanced video placement and targeting', 'reward' => 'Enhanced video'],
                ]
            ],
            [
                'title' => 'Premium Package',
                'slug' => 'video-premium',
                'original_price' => 2400,
                'items' => [
                    ['description' => 'Perfect for comprehensive video campaigns.', 'reward' => 'Video campaigns'],
                    ['description' => '250,000 video views', 'reward' => 250000],
                    ['description' => 'Premium video placements and analytics', 'reward' => 'Premium video'],
                ]
            ],
            [
                'title' => 'Ultra Package',
                'slug' => 'video-ultra',
                'original_price' => 4200,
                'items' => [
                    ['description' => 'Maximum video exposure for large-scale campaigns.', 'reward' => 'Video dominance'],
                    ['description' => '500,000 video views', 'reward' => 500000],
                    ['description' => 'Ultra-premium placements and full video suite', 'reward' => 'Ultra video'],
                ]
            ],
        ];
    }

    /**
     * Helper method to create plans with their items
     */
    private function createPlansWithItems(SubCategory $subCategory, array $plansData): void
    {
        foreach ($plansData as $planData) {
            $plan = Plan::create([
                'sub_category_id' => $subCategory->id,
                'title' => $planData['title'],
                'slug' => $planData['slug'],
                'original_price' => $planData['original_price'],
                'status' => true,
            ]);

            // Create plan items
            foreach ($planData['items'] as $itemData) {
                PlanItem::create([
                    'plan_id' => $plan->id,
                    'description' => $itemData['description'],
                    'reward' => $itemData['reward'],
                ]);
            }
        }
    }
}
