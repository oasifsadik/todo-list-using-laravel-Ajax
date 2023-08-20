<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" integrity="sha512-uKQ39gEGiyUJl4AI6L+ekBdGKpGw4xJ55+xyJG7YFlJokPNYegn9KwQ3P8A7aFQAUtUsAQHep+d/lrGqrbPIDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).ready(function () {
       //add task
        $(document).on('click','.add_task', function (e) {
            e.preventDefault();
            let task = $('#task').val();
            // console.log(task);
            $.ajax({
                method: 'post',
                url: "{{ url('/add-task') }}",
                data: {task:task},
                success: function (response) {
                    if(response.status == 'success'){
                        $('#addTaskForm')[0].reset();
                        $('.table').load(location.href+' .table');
                    }
                },error:function(err){
                    let error = err.responseJSON;
                    $.each(error.errors,function(indexInArray,valueOfElement){
                    $('.errMsgCOntainer').append('<span class="text-danger">'+valueOfElement+'</span>'+'<br>');
                    })
                }
            });

        });

        //show data for edit
        $(document).on('click','.update_tasks_form',function(){
            let id = $(this).data('id');
            let task = $(this).data('task');

            $('#up_id').val(id);
            $('#up_task').val(task);

        });
        //update
        $(document).on('click','.update_task', function (e) {
            e.preventDefault();
            let up_id = $('#up_id').val();
            let up_task = $('#up_task').val();
            $.ajax({
                method: 'post',
                url: "{{ url('/update-task') }}",
                data: {
                    up_id : up_id,
                    up_task : up_task
                },
                success: function (response) {
                    if(response.status == 'success'){
                        $('#updatemodal').modal('hide');
                        $('#update_tasks_form')[0].reset();
                        $('.table').load(location.href+' .table');
                    }
                },error:function(err){
                    let error = err.responseJSON;
                    $.each(error.errors,function(indexInArray,valueOfElement){
                    $('.errMsgCOntainer').append('<span class="text-danger">'+valueOfElement+'</span>'+'<br>');
                    })
                }
            });

        });
        // delete data
        $(document).on('click','.delete_task' , function(e){
            e.preventDefault();

            let task_id = $(this).data('id');
            if(confirm('Are You Sure')){

                $.ajax({
                    url: "{{ url('/delete-task') }}",
                    method : "get",
                    data: {
                        task_id:task_id,
                    },
                    success: function (response) {
                        if(response.status =='success')
                        {
                            $('.table').load(location.href+' .table');
                        }
                    },
                });
            }
        });
   });
</script>
</body>
</html>
