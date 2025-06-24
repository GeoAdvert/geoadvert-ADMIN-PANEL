<script>
    jQuery(document).ready(function(){
        const interval = 60000;
        setInterval(function(){

            $.ajax({
                url: '{{ route('login-status') }}',
                type: 'POST',
                data:{
                    "_token": "{{ csrf_token() }}",
                },
                success:function(res){
                    console.log(res.message);
                }
            })

        }, interval);
    });
</script>
