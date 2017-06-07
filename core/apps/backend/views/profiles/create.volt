{% extends "layouts/base.volt" %}
{% block content %}
<form method="post" autocomplete="off">

{{ link_to("/backend/profiles/index", "&larr; Go Back" , 'class' :'btn btn-outline-primary') }}

{{ submit_button("Save", "class": "btn btn-success float-right") }}


<h1>Create a Profile</h1>

<div class="center scaffold">

    <div class="form-group row">
        <label for="name" class="col-2 col-form-label">Name</label>
        <div class="col-10">
        {{ form.render("name") }}
        </div>
    </div>

    <div class="form-group row">
        <label for="active" class="col-2 col-form-label">Active?</label>
        <div class="col-10">
        {{ form.render("active") }}
        </div>
    </div>

 

</div>

</form>
{% endblock %}