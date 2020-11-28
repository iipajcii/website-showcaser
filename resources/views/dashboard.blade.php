<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/bulma.css')}}">
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
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
    <section class="hero is-primary is-bold mb-4">
      <div class="hero-body">
        <div class="container has-text-centered">
          <h1 class="title">
            Dashboard
          </h1>
          <h2 class="subtitle">
            The administrator dashboard for showcaser
          </h2>
        </div>
      </div>
    </section>
    <div class="tabs is-centered">
      <ul>
        <li class="is-active" name="home" onclick="toggleTab(this)"><a>Home</a></li>
        <li name="create-entry" onclick="toggleTab(this)"><a>Create Entry</a></li>
        <li name="edit-entry" onclick="toggleTab(this)"><a>Edit Entry</a></li>
        <li name="toggle-entry" onclick="toggleTab(this)"><a>Toggle Entry</a></li>
      </ul>
    </div>
    <div class="columns" id="view">
        {{-- Home View Start --}}
        <div class="column is-full has-text-centered" name="home">
            <h1>Recent Activity</h1>
            <div class="columns is-multiline">
                @foreach($recent as $activity)<div class="column is-full"><span>{{$activity->created_at}} -- {{$activity->id}}</span></div>@endforeach
            </div>
        </div>
        {{-- Home View Stop --}}

        {{-- Create Entry Start --}}
        <div class="column is-full has-text-centered is-hidden" name="create-entry">
            <h1>Create Entry</h1>
            <div class="columns is-centered">
                <div class="column is-7">
                    <form method="post" action="{{route('api-create-website')}}">
                        <div class="field">
                            <label class="label">Name</label>
                            <div class="control">
                                <input class="input" type="text" placeholder="e.g The New Awesome Website" name="name"/>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Website Link</label>
                            <div class="control">
                                <input class="input" type="text" placeholder="e.g. https://the-new-awesome-website.com" name="link" />
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Website Description</label>
                            <div class="control">
                                <textarea class="textarea" placeholder="e.g. This is the awesome website &#10That is available for purchase!" rows="6" name="description"></textarea>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Categories</label>
                            <div class="control">
                                <input class="input" type="text" placeholder="e.g. School+Business+Blog" name="categories" />
                            </div>
                            <p class="help">Add a '+' for each category there is</p>
                        </div>
                        <div class="control">
                            <label>Is Hidden?</label><br/>
                            <label class="radio">
                                <input type="radio" name="hidden" value=1 checked> Yes
                            </label>
                            <label class="radio">
                                <input type="radio" name="hidden" value=0> No
                            </label>
                        </div>
                        <div class="field">
                            <p class="control">
                                <button class="button is-success">Login</button>
                            </p>
                        </div>
                    </form>
                </div>
        </div>
        {{-- Create Entry Stop  --}}

        {{-- Edit Entry Start --}}
        <div class="column is-full has-text-centered is-hidden" name="edit-entry"><h1>Edit Entry</h1></div>
        {{-- Edit Entry Stop  --}}

        {{-- Toggle Entry Start --}}
        <div class="column is-full has-text-centered is-hidden" name="toggle-entry"><h1>Toggle Entry</h1></div>
        {{-- Toggle Entry Stop  --}}
    </div>
</body>
</html>
