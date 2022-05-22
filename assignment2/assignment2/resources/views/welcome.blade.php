<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Assignment</title>
    @toastr_css
</head>

<body>

    <main class="main mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="card p-4">
                        <h2>Create Category</h2>
                        <form action="{{ route('category_store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="category">Name</label>
                                <input required type="text" name="name" value="{{ old('name') }}" class="form-control">
                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="form-group mt-2">
                                <select name="parent" class="form-control">
                                    <option value="">Select One</option>
                                    @foreach ($category as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="button mt-2 text-center">
                                <button class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card p-4">
                        <div class="form-group show_category">

                            <select onchange="categorySync(this)" name="category" class="form-control">
                                <option value="">Select One</option>
                                @foreach ($category as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    @jquery
    @toastr_js
    @toastr_render
    <script>
        function categorySync(el){
            $cat = $(el).val() // we are getting id from cat tjos id
            $.ajax({ //ajax request start from here
                url:'getdata/'+$cat, //this is route get data with id//fatcing all child data according to parent id
                dataType: 'json',
                success:function(response){
                    var select =  ` <select onchange="categorySync(this)" name="category" class="form-control mt-2"> 
                        <option value="">Select One</option>` //this is select html tag
                    $.each(response, function(i, value){ //this is loop. here looping data according to parent id
                        console.log(value)
                        select += `
                        <option value=`+value.id+`>`+ value.name +`</option>
                        `
                    })
                    select += ` </select>` // end html tag
                    
                    $('.show_category').append(select) // now appending data to this class section 
                }
            })
        }
    </script>

</body>

</html>