{% extends "layouts/base.volt" %}
{% block content %}
 <section id="content-full">
 <h1>{{ user.username}}</h1>
 
<ul class="entry-list">
 {% for entry in entries %}
 	
	 	<li>
	 	 <a href="/entry/{{ entry.getId() }}">{{ entry.post.title }} (#{{ entry.getId() }})</a> 
  		<div class="entry-meta">{{ getHumanDate(entry.createdAt)  }} </div>
 
 	</li>
 {% endfor %}
</ul>

{% if totalPages > 1 %}
    {% set controller = this.view.getControllerName() | lower  %}
    {% set action = this.view.getActionName() | lower %}

    {% set startIndex = 1  %}
 
	           
            sayfa:  <select onchange="if (this.value) window.location.href=this.value">
            {% for pageIndex in startIndex..totalPages %}

                <option value="?page={{pageIndex}}" {% if pageIndex is currentPage %}selected{% endif %}>{{ pageIndex }}</option>
 
            {% endfor %}
            </select>
            /  <a href="?page={{ totalPages }}">{{ totalPages }}</a>
    </br>
    </br>
{% endif %}

</section>
{% endblock %}