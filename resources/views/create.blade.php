<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        select.form-control option {
  background-color: #f2f2f2;
  color: #000;
}

select.form-control::before {
  content: '\f078';
  font-family: 'Font Awesome 5 Free';
  font-weight: 900;
  position: absolute;
  right: 10px;
  top: 50%;
  transform: translateY(-50%);
}

select.form-control::after {
  content: '';
  position: absolute;
  right: 0;
  top: 50%;
  transform: translateY(-50%);
  width: 20px;
  height: 20px;
  background-color: #fff;
  border: 1px solid #ced4da;
  border-radius: 4px;
  pointer-events: none;
}

    </style>
</head>
<body>



<!-- Small modal -->








        <div class="container">
        <form action="{{ route('apartment.store') }}" method="POST"> 
        @csrf
        <h3>price range</h3>
        <p>The average nightly price is $80, not including fees or taxes.</p>

            <div class="container">
                <div class="row">
                    <div class="col-sm">
                    <div class="input-group mb-3">
                        <input type="text" name="id" class="form-control" placeholder="Enter your input" aria-label="Enter your input" aria-describedby="minimum-text">
                        <div class="input-group-append">
                            <span class="input-group-text" id="minimum-text">id</span>
                        </div>
                    </div>
                    </div>
                    <div class="col-sm">
                    <div class="input-group mb-3">
                        <input type="text" name="title" class="form-control" placeholder="Enter your input" aria-label="Enter your input" aria-describedby="minimum-text">
                        <div class="input-group-append">
                            <span class="input-group-text" id="minimum-text">title</span>
                        </div>
                    </div>
                    </div>
                    
                </div>
                <div class="row">
                <div class="col-sm">
                    <div class="input-group mb-3">
                        <input type="text" name="photo" class="form-control" placeholder="Enter your input" aria-label="Enter your input" aria-describedby="minimum-text">
                        <div class="input-group-append">
                            <span class="input-group-text" id="minimum-text">photo</span>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="row">
                <div class="col-sm">
                    <div class="input-group mb-3">
                        <input type="text" name="desc" class="form-control" placeholder="Enter your input" aria-label="Enter your input" aria-describedby="minimum-text">
                        <div class="input-group-append">
                            <span class="input-group-text" id="minimum-text">descreption</span>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="row">
                <div class="col-sm">
                    <div class="input-group mb-3">
                        <input type="text" name="extra" class="form-control" placeholder="Enter your input" aria-label="Enter your input" aria-describedby="minimum-text">
                        <div class="input-group-append">
                            <span class="input-group-text" id="minimum-text">extrainfo</span>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm">
                    <div class="input-group mb-3">
                        <input type="text" name="price" class="form-control" placeholder="Enter your input" aria-label="Enter your input" aria-describedby="minimum-text">
                        <div class="input-group-append">
                            <span class="input-group-text" id="minimum-text">price</span>
                        </div>
                    </div>
                    </div>
                    
                </div>

            <h3 style="margin-top: 20px;">
                number of guests
            </h3>
                <div class="input-group mb-3">
                        <input type="text" name="ming" class="form-control" placeholder="Enter your input" aria-label="Enter your input" aria-describedby="minimum-text">
                        <div class="input-group-append">
                            <span class="input-group-text" id="minimum-text">maximum</span>
                        </div>
                </div>
            <h3 style="margin-top: 20px;">
                property type
            </h3>
            <div class="form-group">
                    <label for="custom-select">choose your apartement type:</label>
                    <select class="form-control" name="type" id="custom-select">
                    <option value="">Select a country</option>
                        <option value="apartement">apartement</option>
                        <option value="room">room</option>
                        <option value="shared house">shared house</option>
                    </select>
            </div>

            
            <h3 style="margin-top: 20px;">
                perks
            </h3>

            <div class="container">
            <div class="row">
                <div class="col-sm">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="wifi" name="perks[]" class="custom-control-input" id="customCheck1">
                    <label class="custom-control-label" for="customCheck1">wifi</label>
                 </div>
                </div>
                <div class="col-sm">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="tv" name="perks[]" class="custom-control-input" id="customCheck1">
                    <label class="custom-control-label" for="customCheck1">tv</label>
                 </div>
                </div>  
            </div>
            <div class="row">
                <div class="col-sm">
                <div class="custom-control custom-checkbox">
                    <input value="dryer" type="checkbox" name="perks[]" class="custom-control-input" id="customCheck1">
                    <label class="custom-control-label" for="customCheck1">dryer</label>
                 </div>
                </div>
                <div class="col-sm">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="kitchen" name="perks[]" class="custom-control-input" id="customCheck1">
                    <label class="custom-control-label" for="customCheck1">kitchen</label>
                 </div>
                </div>  
            </div>
        </div>

        <h3 style="margin-top: 20px;">adresse</h3>

            <div class="container"  style="margin-bottom: 20px;">
                <div class="row">
                    <div class="col-sm">
                    <div class="form-group">
                    <label for="country">Select a country:</label>
                        <select id="country" class="form-select" name="wilaya">
                            <option value="">Select a country</option>
                            <option value="Algeria">Algeria</option>
                            <option value="England">England</option>
                        </select>
                    </div>
                    </div>
                    
                    <div class="col-sm">
                    <div class="form-group">
                    <label for="state">Select a state:</label>
                        <select class="form-select" id="state" name="commune" disabled>
                            <option value="">Select a state</option>
                        </select>
                    </div>
                    </div>
                    </div>
                    
                </div>
                <button type="submit" class="btn btn-primary mb-3">Submit</button>
            </div>

            
        </form>
            </div>
        </div>
</div>
<script>
    const stateSelect = document.querySelector('#state');
    const countrySelect = document.querySelector('#country');

    countrySelect.addEventListener('change', function () {
        const selectedCountry = this.value;

        // Clear the state options
        stateSelect.innerHTML = '<option value="">Select a state</option>';

        if (!selectedCountry) {
            // Disable the state select if no country is selected
            stateSelect.disabled = true;
            return;
        }

        // Enable the state select and fetch the corresponding states for the selected country
        stateSelect.disabled = false;

        fetch(`/get-states/${selectedCountry}`)
            .then(response => response.json())
            .then(states => {
                // Populate the state select options with the corresponding states
                for (const state of states) {
                    const option = document.createElement('option');
                    option.value = state;
                    option.textContent = state;
                    stateSelect.appendChild(option);
                }
            })
            .catch(error => {
                console.error(error);
            });
    });

</script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>