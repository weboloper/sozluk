{% extends "layouts/base.volt" %}
{% block content %}

{{ link_to("backend/users/create", "<i class='icon-plus-sign'></i> Create Users", "class": "btn btn-primary float-right") }}
 
<h1>Search users</h1>

<form method="post" action="{{ url("/backend/users/search") }}" autocomplete="off">

    <div class="center scaffold">

        

        <div class="col-md-8">
            
        <div class="form-group row">
            <label for="id" class="col-2 col-form-label">Id</label>
            <div class="col-10">
            {{ form.render("id") }}
            </div>
        </div>

        <div class="form-group row">
            <label for="name" class="col-2 col-form-label">Name</label>
            <div class="col-10">
            {{ form.render("name") }}
            </div>
        </div>

        <div class="form-group row">
            <label for="name" class="col-2 col-form-label">Username</label>
            <div class="col-10">
            {{ form.render("username") }}
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-2 col-form-label">E-Mail</label>
            <div class="col-10">
            {{ form.render("email") }}
            </div>
        </div>

       <div class="form-group row">
            <label for="profilesId" class="col-2 col-form-label">Profile</label>
            <div class="col-10">
            {{ form.render("profilesId") }}
            </div>
        </div>

        <div class="form-group row" >
            {{ submit_button("Search", "class": "btn btn-primary") }}
        </div>

    </div>
    </div>

</form>
{% endblock %}
