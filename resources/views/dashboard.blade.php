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
        .max-95 {
            max-width: 95%;
            margin: auto;
        }
    </style>
    <script type="text/javascript">
        function toggleTab(element){
            document.getElementsByName('edit-entry-main')[0].classList.remove('is-hidden');

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
            for(counter = 1; document.getElementsByName('edit-entry-'+counter)[1]; counter++)
            {
                if(document.getElementsByName('edit-entry-'+counter)[1].tagName.toLowerCase() == 'div'){
                    console.log(counter);
                    document.getElementsByName('edit-entry-'+counter)[1].classList.add('is-hidden');
                }

            }
        }

        function toggleEditor(element) {
            let viewElements = document.getElementById('edit-entry-pages').children;
            let name = element.getAttribute("name");
            let elements = document.getElementsByName(name);
            console.log(elements);

            for(let counter = 0, count = viewElements.length; counter < count; counter++)
            {
                viewElements[counter].classList.add('is-hidden');
            }
            for(let counter = 0, count = elements.length; counter < count; counter++)
            {
                if(elements[counter].getAttribute('name') == name){
                    elements[counter].classList.remove('is-hidden');
                }
            }
            document.getElementsByName('edit-entry-main')[0].classList.add('is-hidden');

        }

        function displayImage(imgElement){
            var reader = new FileReader();
            reader.onload = function()
            {
                var output = document.getElementById(imgElement);
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
            document.getElementById('image-name').innerHTML = document.getElementsByName('image')[0].files[0].name;
        };

        function displayEditorImage(imgElement){
            var reader = new FileReader();
            reader.onload = function()
            {
                var output = document.getElementById(imgElement);
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
            // document.getElementById('image-name').innerHTML = document.getElementsByName('image')[0].files[0].name;
        };
    </script>
    <section class="hero is-primary is-bold mb-4">
      <div class="hero-body">
        <div class="container has-text-centered">
          <h1 class="title is-size-2">
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
            <h1 class="is-size-3  mb-4">Recent Activity</h1>
            <hr class="mb-5" style="width: 70%; background-color: #DDD; height: 1px; margin: auto;">
            <div class="columns is-multiline">
                @foreach($recent as $activity)<div class="column is-full"><span>{{$activity}}</span></div>@endforeach
            </div>
        </div>
        {{-- Home View Stop --}}

        {{-- Create Entry Start --}}
        <div class="column is-full has-text-centered is-hidden" name="create-entry">
            <h1 class="is-size-3  mb-4">Create Entry</h1>
            <hr class="mb-5" style="width: 70%; background-color: #DDD; height: 1px; margin: auto;">
            <div class="columns is-centered">
                <div class="column is-7">
                    <form method="post" action="{{route('api-create-website')}}" enctype="multipart/form-data" >
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
                            <label class="label">Website Display Image</label>
                            <img id='website-showcase-image' src="https://bulma.io/images/placeholders/1280x960.png"/>
                            <div class="file has-name is-fullwidth">
                            <label class="file-label">
                                <input class="file-input" type="file" name="image" onchange="displayImage('website-showcase-image')" required>
                                <span class="file-cta">
                                    <span class="file-icon">
                                        <i class="fas fa-upload"></i>
                                    </span>
                                    <span class="file-label">Choose a file…</span>
                                </span>
                                <span class="file-name" id="image-name">Default Image is currently selected</span>
                            </label>
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
        </div>
        {{-- Create Entry Stop  --}}

        {{-- Edit Entry Start --}}
        <div class="column is-full has-text-centered is-hidden"  style="z-index: 1" name="edit-entry">
            <div name="edit-entry-main">
                <h1 class="is-size-3  mb-4">Edit Entry</h1>
                <hr class="mb-5" style="width: 70%; background-color: #DDD; height: 1px; margin: auto;">
                <div class="columns is-multiline">
                {{-- One Line Component--}}@foreach($website as $site)<div class="column is-4"><div class="card max-95"><div class="card-image"><picture class="image is-square"><source srcset="{{asset(str_replace('public','storage',$site->image).'.square.webp')}}" type="image/webp"><img src="{{asset(str_replace('public','storage',$site->image).'.square.jpeg')}}" type="image/jpeg"alt="Website Image"></picture></div><div class="card-content"><div class="media"><div class="media-left"></div><div class="media-content"><p class="title is-4">{{$site->name}}</p><p class="subtitle is-6">@foreach(explode("+",$site->categories) as $tag)<span class="tag is-info mr-1">{{$tag}}</span>@endforeach</p></div></div><div class="content">{{$site->description}}<br><div class="columns mt-3"><div class="column"><button class="button is-primary m-2" style="width: 100%;" onclick="toggleEditor(this)" name="edit-entry-{{$site->id}}">Edit Details</button></div></div></div></div></div></div>@endforeach
                </div>
            </div>
            <div class="columns" id="edit-entry-pages">
                {{-- Edit Entry Pages Start --}}

            @foreach($website as $site)
            <div class="column is-full has-text-centered is-hidden" style="z-index: 2" name="edit-entry-{{$site->id}}">
                <h1 class="is-size-3  mb-4">Edit Entry</h1>
                <hr class="mb-5" style="width: 70%; background-color: #DDD; height: 1px; margin: auto;">
                <div class="columns is-centered">
                    <div class="column is-7">
                        <form method="post" action="{{route('api-edit-website')}}" enctype="multipart/form-data" >
                            <input class="input" type="hidden" placeholder="e.g The New Awesome Website" name="id" value="{{$site->id}}" />
                            <div class="field">
                                <label class="label">Name</label>
                                <div class="control">
                                    <input class="input" type="text" placeholder="e.g The New Awesome Website" name="name" value="{{$site->name}}" />
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Website Link</label>
                                <div class="control">
                                    <input class="input" type="text" placeholder="e.g. https://the-new-awesome-website.com" name="link" value="{{$site->link}}" />
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Website Display Image</label>
                                <img id='website-showcase-image-{{$site->id}}' src="{{asset(str_replace('public','storage',$site->image))}}"/>
                                <div class="file has-name is-fullwidth">
                                <label class="file-label">
                                    <input class="file-input" type="file" name="image" onchange="displayEditorImage('website-showcase-image-{{$site->id}}',{{$site->id}})">
                                    <span class="file-cta">
                                        <span class="file-icon">
                                            <i class="fas fa-upload"></i>
                                        </span>
                                        <span class="file-label">Choose a file…</span>
                                    </span>
                                    <span class="file-name" name="image-name-{{$site->id}}">Default Image is currently selected</span>
                                </label>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Website Description</label>
                                <div class="control">
                                    <textarea class="textarea" placeholder="e.g. This is the awesome website &#10That is available for purchase!" rows="6" name="description">{{$site->description}}</textarea>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Categories</label>
                                <div class="control">
                                    <input class="input" type="text" placeholder="e.g. School+Business+Blog" name="categories" value="{{$site->categories}}" />
                                </div>
                                <p class="help">Add a '+' for each category there is</p>
                            </div>
                            <div class="control">
                                <label>Is Hidden?</label><br/>
                                <label class="radio">
                                    <input type="radio" name="hidden" value=1 @if($site['is-hidden']) checked @endif> Yes
                                </label>
                                <label class="radio">
                                    <input type="radio" name="hidden" value=0 @if(!$site['is-hidden']) checked @endif> No
                                </label>
                            </div>
                            <div class="field">
                                <p class="control">
                                    <button class="button is-success">Update Entry</button>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach

        {{-- Edit Entry Pages Stop  --}}
            </div>
        </div>

        {{-- Edit Entry Stop  --}}

        {{-- Toggle Entry Start --}}
        <div class="column is-full has-text-centered is-hidden" name="toggle-entry"><h1 class="is-size-3 mb-4">Toggle Entry</h1><hr class="mb-5" style="width: 70%; background-color: #DDD; height: 1px; margin: auto;"></div>
        {{-- Toggle Entry Stop  --}}

    </div>
</body>
</html>
