{% block content %}
<div class="container">
        <div class="col-md-4 offset-md-4">
        	<div class="card card-default mt-5">
			  	<div class="card-header">
			    	Kayıt ol
			 	</div>
			  	<div class="card-block">
			    	{{ form('class': 'form-signup') }}
                    <fieldset>
                    	<div class="form-group">
			    		    {{ form.render('name') }}
			    		    {{ form.messages('name') }}
			    		</div>
			    		<div class="form-group">
			    		    {{ form.render('username') }}
			    		    {{ form.messages('username') }}
			    		</div>
			    	  	<div class="form-group">
			    		    {{ form.render('email') }}
			    		    {{ form.messages('email') }}
			    		</div>
			    		<div class="form-group">
			    			{{ form.render('password') }}
			    			{{ form.messages('password') }}
			    		</div>
			    		<div class="form-group">
			    			{{ form.render('confirmPassword') }}
			    			{{ form.messages('confirmPassword') }}
			    		</div>
			    		<div class="checkbox">
			    	    	<label>
			    	    		{{ form.render('terms') }} {{ form.label('terms') }}
			    	    	</label>
			    	    	{{ form.messages('terms') }}
			    	    </div>
			    	    <input type="hidden" name="{{ security.getTokenKey() }}" value="{{ security.getToken() }}" >

			    		 {{ submit_button('Register', 'class' : 'btn btn-success') }}
			    	</fieldset>
			    	
			      	</form>
			    </div>
			</div>
		</div>
</div>
 
{% endblock %}

 
