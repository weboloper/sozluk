{% extends "layouts/base.volt" %}
{% block content %}
<form method="post" autocomplete="off">

{{ link_to("/backend/users/index", "&larr; Go Back" , 'class' :'btn btn-outline-primary') }}

{{ link_to("/backend/users/create", "Create users", "class": "btn btn-primary float-right") }}

<h1>Create a User</h1>

<div class="center scaffold">
    

    <div class="clearfix">
        <label for="name">Name</label>
        {{ form.render("name") }}
    </div>

    <div class="clearfix">
        <label for="name">Username</label>
        {{ form.render("username") }}
    </div>

    <div class="clearfix">
        <label for="email">E-Mail</label>
        {{ form.render("email") }}
    </div>

    <div class="clearfix">
        <label for="profilesId">Profile</label>
        {{ form.render("profilesId") }}
    </div>

</div>

</form>
{% endblock %}