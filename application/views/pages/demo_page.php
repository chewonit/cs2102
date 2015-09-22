<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo $page_title?></h1>
			</div>
		</div>
	</div>

	<div class="row">
	
		<div class="col-md-9">
		    
		    <p>
		        <h3>Note to Team</h3>
		        <ul>
		            <li>
                        Use "controllers/Demo_controller.php" and "views/Demo_page.php" as reference.
                    </li>
		            <li>
                        Create a Controller PHP file of your respective job (Query, Insert, Update, Delete). <br />
                        Make a copy of Demo_controller.php and rename.		                
		            </li>
		            <li>
                        Create a View PHP file of your respective job (Query, Insert, Update, Delete). <br />
                        Make a copy of Demo_page.php and rename.                 
                    </li>
                    <li>
                        The url pointing to your page will be "localhost/cs2102/demo/job/". Where job can be "query", "insert", "update" or "delete".   
                    </li>
		        </ul>
		        
		        <p>
		          <h4>Refer to "Demo_controller.php" test() function for help.</h4>
		        </p>
		        
		        <ul>
                    <li>
                        <b>Query</b>: "$this -> demo_model -> get()". <br />
                        Go to <?php echo anchor('demo/test/query/'); ?> for demo.
                    </li>
                    <li>
                        <b>Insert</b>: "$this -> demo_model -> insert($data)". <br />
                        "$data" is an array containing all the form inputs (Job ID, Company Name, Job Title, etc...). <br />
                        Go to <?php echo anchor('demo/test/insert/'); ?> for demo.
                    </li>
                    <li>
                        <b>Update</b>: <br />
                        $result = "$this -> demo_model -> get($id)". <br />
                        "$id" is the row to be updated. Retrieve the current values to populate into the form. <br /> 
                        "$this -> demo_model -> update($data)". <br />
                        "$data" is an array containing all the UPDATED form inputs by the user after clicking submit button (Job ID, Company Name, Job Title, etc...). <br />
                        Go to <?php echo anchor('demo/test/update/'); ?> for demo.
                    </li>
                    <li>
                        <b>Delete</b>: "$this -> demo_model -> delete($id)". <br />
                        "$id" is the Job ID. <br />
                        Go to <?php echo anchor('demo/test/delete/'); ?> for demo.
                    </li>
		        </ul>
		        
		    </p>
		    
		    <hr />
		
			<p>
				<h4>Project Description</h4>
				The system is a catalogue of job offers and job applicants. 
				Employers can create job offers and search the applicants' database. 
				Job applicants can advertise themselves, search the job offers' database.  
				projects and fund projects. Basic forms of automatic matching can be investigated. 
				Administrators can create, modify and delete all entries.  
				Please refer to <a href="http://www.monster.com.sg" target="_blank">www.monster.com.sg</a>, 
				<a href="http://www.dice.com" target="_blank">www.dice.com</a> or other job offer sites for examples and data.
			
			</p>
			
			<hr />
			
			<?php echo $this -> table -> generate($demo_list); ?>
				
			<hr />
		
		</div>
		<div class="col-md-3">
			<p>
				Sed accumsan augue a lacus luctus condimentum. Aenean aliquam id sapien id molestie. 
				Maecenas eu pharetra turpis. Aenean nec facilisis odio. Mauris sodales sodales suscipit. 
				Morbi rhoncus elit et egestas interdum. Ut et magna ac nisi ultrices mattis in sit amet leo. 
				Nunc consectetur egestas ligula, id vulputate ligula congue id. Pellentesque nec hendrerit arcu, at accumsan massa. 
				Etiam eu varius purus. Vivamus et purus risus. Nam vulputate tempus nulla, id tempor quam pellentesque sed. 
				Etiam mi est, tempus in dapibus sit amet, ultrices et nibh.
			</p>
		</div>
	</div>
