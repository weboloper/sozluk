{% extends "layouts/base.volt" %}
{% block content %}
<form method="post" autocomplete="off">

{{ link_to("/backend/profiles/index", "&larr; Go Back" , 'class' :'btn btn-outline-primary') }}

{{ link_to("/backend/profiles/create", "Create users", "class": "btn btn-primary float-right") }}

 <h1>Edit profile</h1>

<div class="center scaffold">

   
    
    <div role="tabpanel">
    <ul  class="nav nav-tabs" role="tablist" >
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#A" role="tab">Edit</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#B" role="tab">Users</a>
        </li>
 
    </ul>

     
        <div class="tab-content pt-4">
            <div class="tab-pane active" id="A" role="tabpanel">

                <div class="col-sm-4">

                {{ form.render("id") }}

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

            </div>

            <div class="tab-pane" id="B" role="tabpanel">
                <p>
                    <table class="table table-bordered table-striped" align="center">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Banned?</th>
                                <th>Suspended?</th>
                                <th>Active?</th>
                            </tr>
                        </thead>
                        <tbody>
                        {% for user in profile.users %}
                            <tr>
                                <td>{{ user.id }}</td>
                                <td>{{ user.name }}</td>
                                <td>{{ user.banned == 'Y' ? 'Yes' : 'No' }}</td>
                                <td>{{ user.suspended == 'Y' ? 'Yes' : 'No' }}</td>
                                <td>{{ user.active == 'Y' ? 'Yes' : 'No' }}</td>
                                <td width="12%">{{ link_to("/backend/users/edit/" ~ user.id, '<i class="icon-pencil"></i> Edit', "class": "btn") }}</td>
                                <td width="12%">{{ link_to("/backend/users/delete/" ~ user.id, '<i class="icon-remove"></i> Delete', "class": "btn") }}</td>
                            </tr>
                        {% else %}
                            <tr><td colspan="3" align="center">There are no users assigned to this profile</td></tr>
                        {% endfor %}
                        </tbody>
                    </table>
                </p>
            </div>

        </div>
    </div>

    </form>
</div>
{% endblock %}