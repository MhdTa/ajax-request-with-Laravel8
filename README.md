# ajax-request-with-Laravel8
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

### The required steps to setup the project:
* install Laravel
 ```
composer global require laravel/installer
 ```
* download code or clone it
```
 git clone https://github.com/MhdTa/ajax-request-with-Laravel8.git
```
Set database parameter in .env file
* run migrations
 ```php
 php artisan migrate
 ```
 * run the app
 ```
 php artisan serve
 ```
# send ajax request from index view
### Note:
make sure you put this meta tag in head tag:
```html
 <meta name="csrf-token" content="{{ csrf_token() }}">
```
## ajax request:
```javascript

  $.ajax({
                url: "{{ url('/message') }}",
                type: "POST",
                dataType: "JSON",
                data: {
                    "message": document.getElementById('message').value,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    console.log(data.messages);
                },
                error: function() {
                    alert("Nothing Data");
                }
            });
```
## Make routes
```php
Route::post('/message', [messageController::class, 'store'])->name('message.add');
Route::get('/', [messageController::class, 'index'])->name('home');
```
## In the message controller we store the message and return the response
```php
    public function store(Request $request,Post $message){
        $this->validate($request, [
            'message' => 'required',
        ]);

        
        $message->content =  $request->get('message');

        //store in db
        $message->save();

        return response()->json(['messages'=>$message]);

    }
 ```   
   Hope you liked it ..... Mohamed Taha
    
     
