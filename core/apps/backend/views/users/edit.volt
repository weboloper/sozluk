{% extends "layouts/base.volt" %}
{% block content %}
<form method="post" autocomplete="off">

{{ link_to("/backend/users/index", "&larr; Go Back" , 'class' :'btn btn-outline-primary') }}

{{ submit_button("Save", "class": "btn btn-big btn-success float-right") }}

<h1>Edit users</h1>

<div class="center scaffold">

    <div role="tabpanel">
    <ul  class="nav nav-tabs" role="tablist" >
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#A" role="tab">Basic</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#B" role="tab">Successful Logins</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#C" role="tab">Password Changes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#D" role="tab">Reset Passwords</a>
        </li>
 
    </ul>

 
    <div class="tab-content pt-4">
        <div class="tab-pane active" id="A" role="tabpanel">

            {{ form.render("id") }}

            <div class="col-md-8">

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
                    <label for="profilesId" class="col-2 col-form-label">Profile</label>
                    <div class="col-10">
                    {{ form.render("profilesId") }}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="suspended" class="col-2 col-form-label">Suspended?</label>
                    <div class="col-10">
                    {{ form.render("suspended") }}
                    </div>
                </div>

        

                <div class="form-group row">
                    <label for="email" class="col-2 col-form-label">E-Mail</label>
                    <div class="col-10">
                    {{ form.render("email") }}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="banned" class="col-2 col-form-label">Banned?</label>
                    <div class="col-10">
                    {{ form.render("banned") }}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="active" class="col-2 col-form-label">Confirmed?</label>
                    <div class="col-10">
                    {{ form.render("active") }}
                    </div>
                </div>

            </div>
        </div>

        <div class="tab-pane" id="B"  role="tabpanel">
            <p>
                <table class="table table-bordered table-striped" align="center">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>IP Address</th>
                            <th>User Agent</th>
                        </tr>
                    </thead>
                    <tbody>
                    {% for login in user.successLogins %}
                        <tr>
                            <td>{{ login.id }}</td>
                            <td>{{ login.ipAddress }}</td>
                            <td>{{ login.userAgent }}</td>
                        </tr>
                    {% else %}
                        <tr><td colspan="3" align="center">User does not have successfull logins</td></tr>
                    {% endfor %}
                    </tbody>
                </table>
            </p>
        </div>

        <div class="tab-pane" id="C"  role="tabpanel">
            <p>
                <table class="table table-bordered table-striped" align="center">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>IP Address</th>
                            <th>User Agent</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    {% for change in user.passwordChanges %}
                        <tr>
                            <td>{{ change.id }}</td>
                            <td>{{ change.ipAddress }}</td>
                            <td>{{ change.userAgent }}</td>
                            <td>{{ date("Y-m-d H:i:s", change.createdAt) }}</td>
                        </tr>
                    {% else %}
                        <tr><td colspan="3" align="center">User has not changed his/her password</td></tr>
                    {% endfor %}
                    </tbody>
                </table>
            </p>
        </div>

        <div class="tab-pane" id="D"  role="tabpanel">
            <p>
                <table class="table table-bordered table-striped" align="center">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Date</th>
                            <th>Reset?</th>
                        </tr>
                    </thead>
                    <tbody>
                    {% for reset in user.resetPasswords %}
                        <tr>
                            <th>{{ reset.id }}</th>
                            <th>{{ date("Y-m-d H:i:s", reset.createdAt) }}
                            <th>{{ reset.reset == 'Y' ? 'Yes' : 'No' }}
                        </tr>
                    {% else %}
                        <tr><td colspan="3" align="center">User has not requested reset his/her password</td></tr>
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