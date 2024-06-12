@extends("welcome")

<style>

  .waiting{

            margin-top: 10%;
            max-width: 50%;
            margin: auto;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
  }
</style>
@section('title',"contact")

@section('content')
  <div class="waiting">
    <span id="waite"></span><span id="points"></span>
  </div>
  <script>
    window.onload = function() {
      var h = document.querySelector("#waite");
      var p = document.querySelector("#points");
      h.innerHTML = "waite quelque second";

      // Animation des points
      let points = ["", ".", "..", "..."];
      let index = 0;
      let interval = setInterval(function() {
        p.innerHTML = points[index++ % points.length];
      }, 500);

      // Effacer le contenu et arrêter l'intervalle après 6.5 secondes
      setTimeout(function() {
        clearInterval(interval);
        h.innerHTML = "";
        p.innerHTML = "";
      }, 6500);
    }
  </script>
<div class="visme_d" data-title="Contact Us Contact Form" data-url="w466r7n1-contact-us-contact-form?fullPage=true" data-domain="forms" data-full-page="fals" data-min-height="90vh" data-form-id="72207"></div><script src="https://static-bundles.visme.co/forms/vismeforms-embed.js"></script>
@endsection