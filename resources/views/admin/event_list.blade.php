@extends('layouts.admin')

@section('contents')
<div class="card mb-3">
    <div class="card-body">
        <div class="row">
            <div class="col-md-10">
                <input type="text" name="search" class="form-control w-100" placeholder="Search Event" onkeyup="search_filter()" id="filter_search">
            </div>
            <div class="col-md-2">
                <a class="btn btn-primary w-100 ml-0 mr-0 mb-0 mt-negetive4" href="/admin-event">Create
                    Event</a>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover" id="event_table">
                    <thead>
                        <tr>
                            <th scope="col">Event Name</th>
                            <th scope="col">Image</th>
                            <th scope="col">Description</th>
                            <th scope="col">Host</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Prize Pool</th>
                            <th scope="col">Stream Key</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($event as $e)
                        <tr>
                            <td>{{$e->event_name}}</td>
                            <td><img src="{{$e->event_image_url}}" alt="" width="200" height="200"
                                    style="object-fit: cover"></td>
                            <td>{{$e->event_description}}</td>
                            <td>{{$e->event_host_name}}</td>
                            <td>{{$e->event_start_date}}</td>
                            <td>{{$e->event_end_date}}</td>
                            <td>{{$e->event_coins_prize_pool}}</td>
                            <td>{{$e->stream_key}}</td>
                            <td>
                                <a href="/event-edit/{{$e->id}}" class="btn btn-secondary w-100 mb-2">Edit</a>
                                <button class="btn btn-danger w-100 m-0" onclick="event_delete({{$e->id}})">Delete</a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<script>
    function event_delete(id) {

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('/event_delete') }}",
                    method: 'post',
                    data: {
                        "id": id,
                    },
                    success: function (result) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Event Deleted',
                            icon: 'success',
                            confirmButtonText: 'Yes'
                        }).then((result) => {
                            location.reload();
                        })
                    }
                });
            }
        })


    }

    function search_filter() {
    // Declare variables
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("filter_search");
    filter = input.value.toUpperCase();
    table = document.getElementById("event_table");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
        }
    }
    }

</script>



@endsection
