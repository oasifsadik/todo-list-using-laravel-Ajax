@include('include.header')
    <div class="container  mt-5">
       <div class="add-task">
            <div class="col-md-8 offset-2">
                <h1 class="text-center text-white">Todo List </h1>
                <form action="" method="post" id="addTaskForm">
                    @csrf
                    <div class="errMsgCOntainer">

                    </div>
                    <div class="input-group">
                        <input type="text" placeholder="tasks..." name="task" id="task" class="form-control">
                        <button class="btn btn-info add_task">Add Task</button>
                    </div>
                </form>
                <div class="data mt-1">
                     <table class="table table-striped bg-white rounded">
                         <tr>
                             <th>sl</th>
                             <th>Tasks</th>
                             <th class="float-right">Action</th>
                         </tr>
                         @if ($tasks->count() > 0)
                         @foreach ($tasks as $key => $item)
                         <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $item->task }}</td>
                            <td class="float-right">
                                <a class="btn btn-success btn-sm update_tasks_form"
                                     data-bs-toggle="modal" data-bs-target="#updatemodal"
                                     data-id="{{ $item->id }}"
                                     data-task="{{ $item->task }}"
                                ><i class="fa-solid fa-pen-to-square"></i></a>
                                <a
                                class="btn btn-danger btn-sm delete_task"
                                data-id="{{ $item->id }}"
                                ><i class="fa-solid fa-trash"></i></a>
                            </td>
                       </tr>
                         @endforeach
                         @else
                            <td class="text-center "><h4>Empty Todos.....</h4></td>
                         @endif
                    </table>
                </div>
           </div>
       </div>
    </div>


    <div class="modal fade" id="updatemodal" tabindex="-1" aria-labelledby="updatemodal" aria-hidden="true">
        <form action="" method="post" id="update_tasks_form">
         @csrf
         <input type="hidden" id="up_id">
         <div class="modal-dialog">
             <div class="modal-content">
               <div class="modal-header">
                 <h1 class="modal-title fs-5" id="updatemodal">Edit Task</h1>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                 <div class="errmsg mb-2"></div>
                   <div class="form-group mb-2">
                       <label for="name">task</label>
                       <input type="text" name="up_task" id="up_task" class="form-control">
                   </div>
               </div>
               <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                 <button type="button" class="btn btn-primary update_task">update task</button>
               </div>
             </div>
           </div>
        </form>
       </div>

 @include('include.footer')
