<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="bg-gray-200">
    <div style="margin: 20px" class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <textarea id="message" class="bg-gray-200  px-4 py-2 rounded font-medium"> </textarea>
            <button id="ajaxSubmit" onclick="sendMessage()"
                class="bg-blue-500 text-white px-4 py-2 rounded font-medium"> post </button>
        </div>
    </div>

    <div class="justify-center" id="messagesContainer">
        @foreach ($messages as $message)
            <div style="margin: 10px" class="w-8/12 bg-white p-6 rounded-lg">
                <span>{{ $message->id }}</span>
                <span>{{ $message->created_at->diffForHumans() }}</span>
                <p>{{ $message->content }}</p>
            </div>
        @endforeach
    </div>




    <script src="{{ asset('assets/jquery/jquery-1.12.4.min.js') }}"></script>
    <script>
        function sendMessage() {
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
                    var messagesContainer = document.getElementById('messagesContainer');
                    var div = document.createElement('div');
                    div.className = "w-8/12 bg-white p-6 rounded-lg";
                    div.style = "margin: 10px";
                    var id = document.createElement('span');
                    id.textContent = data.messages.id;
                    var date = document.createElement('span');
                    date.textContent = '   now';

                    var message = document.createElement('p');
                    message.textContent = data.messages.content;

                    div.appendChild(id);
                    div.appendChild(date);
                    div.appendChild(message);
                    messagesContainer.appendChild(div);

                },
                error: function() {
                    alert("Nothing Data");
                }
            });
        }
    </script>
</body>

</html>
