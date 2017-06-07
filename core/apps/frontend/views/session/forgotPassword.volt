{% extends "layouts/base.volt" %}
{% block content %}
<div class="container">
        <div class="col-md-4 offset-md-4">
        	<div class="card card-default mt-5">
			  	<div class="card-header">
			    	Şifre hatırlatma
			 	</div>
			  	<div class="card-block">
			    	{{ form('class': 'form-forgotpass') }}
                    <fieldset>
			    	  	<div class="form-group">
			    		    {{ form.render('email') }}
			    		</div>
			    	 
			    		 {{ submit_button('Şifremi hatırlat', 'class' : 'btn btn-success') }}
			    	</fieldset>
			    	
			      	</form>
			    </div>
			</div>
		</div>
</div>
{% endblock %}