{% extends "layouts/base.volt" %}
{% block content %}
<form method="post">

<h1>Manage Permissions</h1>

<div class="well" align="center">

	<table class="perms">
		<tr>
			<td><label for="profileId">Profile</label></td>
			<td>{{ select('profileId', profiles,  'class':'form-control'  , 'using': ['id', 'name'], 'useEmpty': true, 'emptyText': '...', 'emptyValue': '') }}</td>
			<td>{{ submit_button('Search', 'class': 'btn btn-primary', 'name' : 'search') }}</td>
		</tr>
	</table>

</div>

{% if request.isPost() and profile %}

{% for resource, actions in acl.getResources() %}

	 
	<table class="table table-bordered table-striped" align="center">
		<thead>
			<tr>
				<th width="5%"></th>
				<th>{{ resource }}</th>
			</tr>
		</thead>
		<tbody>
			{% for action in actions %}
			<tr>
				<td align="center"><input type="checkbox" name="permissions[]" value="{{ resource ~ '.' ~ action }}"  {% if permissions[resource ~ '.' ~ action] is defined %} checked="checked" {% endif %}></td>
				<td>{{ acl.getActionDescription(action) ~ ' ' ~ resource }}</td>
			</tr>
			{% endfor %}
		</tbody>
	</table>
			
{% endfor %}

{{ submit_button('Submit', 'class': 'btn btn-primary', 'name':'submit') }}   

{% endif %}

</form>

{% endblock %}
