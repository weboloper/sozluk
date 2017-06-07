{% extends "layouts/base.volt" %}
{% block content %}
<div class="jumbotron">
    <h1 class="display-3">{{ name }}</h1>
    <p class="lead">{{ name }}, Phalcon ile uygulama geliştirmek için yazılmış çoklu modül kullanan bir hızlı başlangıç projesidir.</p>
    <p><a class="btn btn-lg btn-success" href="/session/signup" role="button">Kayıt ol</a></p>
 </div>
{% endblock %}