<?php include "include/test_login.php";?>

<html>
    <head>
        <link rel="stylesheet" href="css/expert.style.css">
        <link rel="shortcut icon" href="images/Contact-icon.png" type="image/x-icon">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

        <title> E- research</title>
        <meta charset="utf-8">
        <script src="js/jquery.js"></script>
    </head>
    <body>

        <div class="header">
                <h1>
                    <a href="index.php">
                        La Ligne Scandinave > Expert
                    </a> 
                </h1>

            <div class="right">
                <input id="search" class="inputHeader" type="text" placeholder="you can search here">
                <button class="inputHeader"  id="logoutModal">Logout</button>
            </div>
        </div>

        <div class="container margBottom">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th>Expert</th>
                            <th>Modifier</th>
                        </tr>
                    </thead>
                    <tbody class="tableau">
                        
                    </tbody>
                </table>
            </div>
        </div>
    
        <div class="ajouterExpert">
            <button data-toggle="modal" data-target="#myModal" class="btn btn-success btn-lg" >
                <span class="glyphicon glyphicon-plus"></span>
                Ajouter
            </button>
        </div>

        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Modal Header</h4>
                    </div>
                    
                    <form action="#">            
                        <div class="modal-body">
                            <div class="alert alert-danger messageBox">
                                <strong>Danger!</strong> 
                                <span class="error-txt">
                                    Indicates a dangerous or potentially negative action.
                                </span>
                            </div>
                                <div class="form-group">
                                    <label for="client">Customer:</label>
                                    <input type="text" id="client" name="client" class="form-control" placeholder="enter customer name">
                                </div>  
                                <div class="form-group">
                                    <label for="txt2">Expert:</label>
                                    <input type="text" id="txt2" name="expert" class="form-control" placeholder="enter expert name">
                                </div>  

                        </div>
                            
                        <div class="modal-footer">
                                <button type="submit" class="btn btn-success" id="ajouterExpert">Add expert</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- End Modal -->

        <!-- Modal modification -->
        <div id="myModal2" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Modal Header</h4>
                    </div>
                    
                    <form>            
                        <div class="modal-body">
                            <div class="alert alert-danger messageBox">
                                <strong>Danger!</strong> 
                                <span class="error-txt">
                                    Indicates a dangerous or potentially negative action.
                                </span>
                            </div>
                                <div class="form-group">
                                    <label for="pwd">Password:</label>
                                    <input type="text" id="clientModif" name="clientModif" class="form-control">
                                </div>  
                                <div class="form-group">
                                    <label for="pwd">Password:</label>
                                    <input type="text" id="expertModif" name="expertModif" class="form-control">
                                </div>  

                        </div>
                            
                        <div class="modal-footer">
                                <button type="submit" class="btn btn-success" id="modifierExpert">Save expert</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- End Modal modification -->


        <!-- Modal confirmation -->
        <div class="modal fade" id="myModal3" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Confirmation</h4>
                    </div>
                    <div class="modal-body">
                        <p class="message-txt">Are you sure to activate this account??</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" id="confirm">
                            <span class="glyphicon glyphicon-leaf"></span>
                            Yes
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            <span class="glyphicon glyphicon-eject"></span>
                            No
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin Modal confirmation -->


<script>
    $(document).on('click', 'a[data-role="supprimerExpert"]', function() {
        var id= $(this).data('id');
        $('.message-txt').text('Are you sure to delete row??');
        $('#myModal3').modal('show');
        $('#confirm').click(function() {
            $.ajax({
            url : 'php/supprimer.php',
            method: 'POST',
            data : { delete: id , nomtable: 'expert'},
            success: function(response){
                        $('#myModal3').modal('hide');
                        console.log("delete success");                          
                    }
            });
        });
    });
</script>


        <!-- success message -->
        <div id="snackbar"></div>
        <!-- fin success message -->

        <footer>
            <p>Copyright&copy; 2023</p>
        </footer>

    </body>
</html>

<script src="bootstrap/js/bootstrap.js"></script>
<script src="js/expert.js"></script>
<script src="js/chargement.js"></script>
<script src="js/modification.js"></script>  
<script src="js/apps.js"></script>
<script>
    const table= document.querySelector('.tableau');
    searchBar= document.querySelector('#search');

    searchBar.onkeyup=function() {
        let search= searchBar.value;

        if (search!=="") {
            searchBar.classList.add('active');
        }else{
            searchBar.classList.remove('active');
        }

        var xhr= new XMLHttpRequest();
        xhr.open('POST', 'php/searchExpert.php', true);
        xhr.onload=function() {
            if (xhr.readyState==XMLHttpRequest.DONE) {
                if (xhr.status==200) {
                    let data = xhr.response;
                    table.innerHTML=data;
                }   
            }
        }
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("searchTerm=" + search);
    }
</script>