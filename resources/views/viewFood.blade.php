@extends('layout')
@section('content')

<div class="row">
    <div class="col-sm-2"></div> 

    <div class="col-sm-8">
        <form action="{{ route('deleteSelectedFoods') }}" method="post"> @csrf @method('delete')
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td style="width: 2%;"><button type="button" class="btn btn-outline-info btn-sm" id="selectAll" >Select All</button></td>
                        <td >Image</td>
                        <td>Name</td>
                        <td>Price</td>
                        <td>Category</td>
                        <td style="width: 15%;">Action</td>
                    </tr>
                </thead>

                <tbody>
                    @foreach($foods as $food)
                    <tr>
                        <td><input type="checkbox" name="selectedFoods[]" value="{{ $food->id }}"></td>
                        <td><img src="{{asset('images/')}}/{{$food->image}}" alt="" width="100" class="img-fluid"></td>
                        <td>{{$food->name}}</td>
                        <td>{{$food->price}}</td>
                        <td>{{$food->category}}</td>
                        <td>
                            <!--delete button-->
                            <a href="{{route('deleteFood', ['id'=>$food->id])}}" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure to delete?')">Delete</a>
                            <!--edit button-->
                            <a href="{{route('editFood',['id'=>$food->id])}}" class="btn btn-outline-primary btn-sm">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-danger btn-sm" id="deleteSelectedBtn" onclick="return confirm('Are you sure to delete all?')">Delete Selected</button>
        </form>
    </div>
    <div class="col-sm-2"></div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Select All button click event
        document.getElementById('selectAll').addEventListener('click', function() {
            var checkboxes = document.querySelectorAll('input[name="selectedFoods[]"]');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = true;
            });

            toggleButtonsVisibility();
        });

        // Checkbox change event
        var checkboxes = document.querySelectorAll('input[name="selectedFoods[]"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', toggleButtonsVisibility);
        });

        // Function to toggle buttons visibility based on checkbox status
        function toggleButtonsVisibility() {
            var anyCheckboxChecked = areAnyCheckboxesChecked();
            document.getElementById('deleteSelectedBtn').style.display = anyCheckboxChecked ? 'inline-block' : 'none';
            document.getElementById('selectAll').style.display = anyCheckboxChecked ? 'none' : 'inline-block';
        }

        // Function to check if any checkboxes are checked
        function areAnyCheckboxesChecked() {
            return Array.from(checkboxes).some(function(checkbox) {
                return checkbox.checked;
            });
        }

        // Initially hide the buttons
        toggleButtonsVisibility();
    });
</script>






@endsection