<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/bulma.css')}}">
</head>
<body>
    <style type="text/css">
        .is-hidden {display: none}
    </style>
    <script type="text/javascript">
        function toggleTab(element){
            let viewElements = document.getElementById('view').children;
            let name = element.getAttribute("name");
            let elements = document.getElementsByName(name);
            let tabs = element.parentElement.children;



            for(let counter = 0, count = viewElements.length; counter < count; counter++)
            {
                viewElements[counter].classList.add('is-hidden');
                tabs[counter].classList.remove('is-active');
            }
            element.classList.toggle('is-active');
            for(let counter = 0, count = elements.length; counter < count; counter++)
            {
                if(elements[counter].getAttribute('name') == name){
                    elements[counter].classList.remove('is-hidden');
                }
            }
        }
    </script>
    <h1>Dashboard</h1>
    <div class="tabs is-centered">
      <ul>
        <li class="is-active" name="home" onclick="toggleTab(this)"><a>Home</a></li>
        <li name="create-entry" onclick="toggleTab(this)"><a>Create Entry</a></li>
        <li name="edit-entry" onclick="toggleTab(this)"><a>Edit Entry</a></li>
        <li name="toggle-entry" onclick="toggleTab(this)"><a>Toggle Entry</a></li>
      </ul>
    </div>
    <div class="columns" id="view">
        <div class="column is-full has-text-centered" name="home"><h1>Home</h1></div>
        <div class="column is-full has-text-centered is-hidden" name="create-entry"><h1>Create Entry</h1></div>
        <div class="column is-full has-text-centered is-hidden" name="edit-entry"><h1>Edit Entry</h1></div>
        <div class="column is-full has-text-centered is-hidden" name="toggle-entry"><h1>Toggle Entry</h1></div>
    </div>
</body>
</html>
