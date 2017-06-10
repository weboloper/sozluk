<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>{{name}}</title>

    <link rel="stylesheet" href="/css/style.css">
    
  </head>

  <body>

    {{ partial('partials/header')}}

    <div id="container">
        <div id="row">
        {{ flash.output() }}

        {% block content %}{% endblock %}
        </div><!-- /.row -->
        {{ partial('partials/footer')}}
    </div><!-- /.container -->

    

    <script type="text/javascript" src="/js/jquery-3.1.1.slim.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
  </body>
</html>
