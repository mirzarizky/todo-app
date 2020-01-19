<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register here</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<?php
    //koneksi ke database
    $host = "eskopi.database.windows.net";
    $user = "admin123";
    $pass = "nSh2Ho4O2z^X";
    $db = "dicoding_db";
    try {
        $conn = new PDO("sqlsrv:server = $host; Database = $db", $user, $pass);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    } catch(Exception $e) {
        echo "Failed: " . $e;
    }
    
    //insert to db
    if (isset($_POST['submit'])) {
            try {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $job = $_POST['job'];
                $date = date('Y-m-d');

                // Insert data
                $sql_insert = "INSERT INTO users (name, email, job, created_at) 
                            VALUES (?,?,?,?)";
                $stmt = $conn->prepare($sql_insert);
                $stmt->bindValue(1, $name);
                $stmt->bindValue(2, $email);
                $stmt->bindValue(3, $job);
                $stmt->bindValue(4, $date);
                $stmt->execute();
            } catch(Exception $e) {
                echo "Failed: " . $e;
            }
        }
 ?>
<body class="bg-light">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-12 mx-auto">
                <div class="text-center">
                    <h2>Register here</h2>
                    <p>Fill your name and email address, then click submit to register.</p>
                </div>
            </div>
            <div class="col-lg-6 mx-auto mb-4">
                <div class="card">
                    <div class="card-body">
                        <form action="index.php" method="POST">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input name="name" id="name" type="text" class="form-control" placeholder="Your Name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input name="email" id="email" type="text" class="form-control" placeholder="Your Email" required>
                            </div>
                            <div class="form-group">
                                <label for="text">Job</label>
                                <input name="job" id="text" type="text" class="form-control" placeholder="Your Job" required>
                            </div>
                            <div class="form-group">
                                <input name="submit" class="btn btn-primary" type="submit" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body p-0">
                    
                        <table class="table table-hover mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Job</th>
                                    <th scope="col">Registered at</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                    try {
                                        $sql_select = "SELECT * FROM users";
                                        $stmt = $conn->query($sql_select);
                                        $registrants = $stmt->fetchAll(); 
                                        if(count($registrants) > 0) {
                                           $i=1;
                                            foreach($registrants as $registrant) {
                                                echo "<tr><td>".$i."</td>";
                                                echo "<td>".$registrant['name']."</td>";
                                                echo "<td>".$registrant['email']."</td>";
                                                echo "<td>".$registrant['job']."</td>";
                                                echo "<td>".$registrant['date']."</td></tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='5'>No one is currently registered.</td></tr>";
                                        }
                                    } catch(Exception $e) {
                                        echo "Failed: " . $e;
                                    }
                                

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>