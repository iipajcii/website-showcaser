<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1 ">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bulma.css')}}">
    <title>Website Showcase</title>
</head>
<body>
    <style type="text/css">
        h1, h2, h3, h4, h5 {
            text-align: center;
        }

        .max-95 {
            max-width: 95%;
            margin: auto;
        }
    </style>
    <script type="text/javascript">
        function toggleIsActive(element)
        {
            console.log(element);
            element.classList.toggle('is-active');
        }
    </script>
    <section class="hero is-primary is-bold mb-4">
      <div class="hero-body">
        <div class="container has-text-centered">
          <h1 class="title">
            Website Showcase
          </h1>
          <h2 class="subtitle">
            Where you can view the website for you
          </h2>
        </div>
      </div>
    </section>
    <div class="columns is-multiline">
        @foreach($website as $site)
        <div class="column is-4"><div class="card max-95"><div class="card-image"><figure class="image is-4by3"><img src="https://bulma.io/images/placeholders/1280x960.png" alt="Placeholder image"></figure></div><div class="card-content"><div class="media"><div class="media-left"></div><div class="media-content"><p class="title is-4">{{$site->name}}</p><p class="subtitle is-6">@foreach(explode("+",$site->categories) as $tag)<span class="tag is-info mr-1">{{$tag}}</span>@endforeach</p></div></div><div class="content">{{$site->description}}<br><div class="columns mt-3"><div class="column"><a href="{{$site->link}}" traget="_target" style="color:white"><button class="button is-primary m-2" style="width: 100%;">View Demo</button></a></div><div class="column"><button class="button is-ghost m-2" style="width: 100%;" onclick="toggleIsActive(document.getElementById('website-modal-{{$site->id}}'))">View Details</button></div></div></div></div></div></div>
        @endforeach
    </div>

    <div class="website-modals">
        @foreach($website as $modal)
        <div id="website-modal-{{$modal->id}}" class="modal"><div class="modal-background"></div><div class="modal-card"><header class="modal-card-head"><p class="modal-card-title">{{$site->name}}</p><button class="delete" aria-label="close" onclick="toggleIsActive(this.parentElement.parentElement.parentElement)"></button></header><section class="modal-card-body"><!-- Content Start --><figure class="image is-4by3"><img src="https://bulma.io/images/placeholders/1280x960.png" alt="Placeholder image"/></figure>{{$modal->description}}<hr style="width: 100%;" /><span class="is-size-3">Features</span><ul class="pl-2"><li>&mdash; a</li><li>&mdash; s</li><li>&mdash; d</li><li>&mdash; d</li><li>&mdash; sd</li></ul><!-- Content End --></section><footer class="modal-card-foot"><button class="button is-success"> <a href="{{$modal->link}}" target="_blank" style="color:#FFF">View Demonstration</a></button><button class="button" onclick="toggleIsActive(this.parentElement.parentElement.parentElement)">Close</button></footer></div></div>
        @endforeach
    </div>
</body>
</html>
