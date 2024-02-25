
<?php
$host = 'localhost';
$dbname = 'acv_db';
$user = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if(isset($_POST['verify'])) {
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

    // Retrieve form data
    $dogName = $_POST['dogname'];
    $schedule = $_POST['schedule'];
    $dogAge = $_POST['dogage'];
    $dogColor = $_POST['dogcolor'];
    $dogGender = $_POST['doggender'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $birthdate = $_POST['birthdate'];
    $address = $_POST['address'];
    $sex = $_POST['sex'];
    $citizenship = $_POST['citizenship'];
    $contact = $_POST['contact'];
    $spouse = $_POST['spouse'];
    $children = $_POST['children'];
    $reasonForAdoption = $_POST['reason'];
    $employmentStatus = $_POST['employment_status'];
    $incomeSource = $_POST['income_source'];
    $monthlyIncome = $_POST['monthly_income'];
    $veterinarian = isset($_POST['veterinarian']) ? $_POST['veterinarian'] : 'No';
    $pets = isset($_POST['pets']) ? $_POST['pets'] : 0;
    // Retrieve the age from the form submission
    $age = isset($_POST['age']) ? intval($_POST['age']) : 0; // Convert to integer

    if ($_FILES["image"]["error"] == 4) {
        echo "<script> alert('Image Does Not Exist'); </script>";
    } else {
        $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = pathinfo($fileName, PATHINFO_EXTENSION);

        if (!in_array(strtolower($imageExtension), $validImageExtension)) {
            echo "<script> alert('Invalid Image Extension'); </script>";
        } else if ($fileSize > 100000000) {
            echo "<script> alert('Image Size Is Too Large'); </script>";
        } else {
            $newImageName = uniqid() . '.' . $imageExtension;
            $targetDir = $_SERVER['DOCUMENT_ROOT'] . '/CapstoneAdmin/upload/IDs/';
            $targetPath = $targetDir . $newImageName;

            if (move_uploaded_file($tmpName, $targetPath)) {
                // Check qualification criteria
                if (
                    ($employmentStatus === 'employed' || $employmentStatus === 'self_employed') &&
                    ($monthlyIncome === '3000-5000' || $monthlyIncome === '5000-above') &&
                    ($age >= 18 && ($reasonForAdoption >= '1' && $reasonForAdoption <= '6'))
                ) {
                    $qualificationStatus = 'Qualified';
                } elseif (
                    ($employmentStatus === 'unemployed') &&
                    ($incomeSource === 'savings' || $incomeSource === 'allowance') &&
                    !($monthlyIncome === '3000-5000' || $monthlyIncome === '5000-above') &&
                    ($age >= 18 && ($reasonForAdoption >= '1' && $reasonForAdoption <= '6'))
                ) {
                    $qualificationStatus = 'Not Qualified';
                } elseif (
                    ($employmentStatus === 'unemployed') &&
                    ($incomeSource === 'savings' || $incomeSource === 'allowance') &&
                    ($monthlyIncome === '3000-5000' || $monthlyIncome === '5000-above') &&
                    ($age >= 18 && ($reasonForAdoption >= '1' && $reasonForAdoption <= '6'))
                ) {
                    $qualificationStatus = 'Qualified';
                } elseif (
                    ($employmentStatus === 'employed' || $employmentStatus === 'self_employed') &&
                    ($incomeSource === 'savings' || $incomeSource === 'allowance' || $incomeSource === 'business' || $incomeSource === 'employment') &&
                    ($monthlyIncome === '3000-5000' || $monthlyIncome === '5000-above') &&
                    ($age >= 18 && ($reasonForAdoption >= '1' && $reasonForAdoption <= '6'))
                ) {
                    $qualificationStatus = 'Qualified';
                }  elseif (
                    ($employmentStatus === 'employed' || $employmentStatus === 'self_employed') &&
                    ($incomeSource === 'savings' || $incomeSource === 'allowance' || $incomeSource === 'business' || $incomeSource === 'employment') &&
                    !($monthlyIncome === '3000-5000' || $monthlyIncome === '5000-above') &&
                    ($age >= 18 && ($reasonForAdoption >= '1' && $reasonForAdoption <= '6'))
                ) {
                    $qualificationStatus = 'Not Qualified';
                } else {
                    $qualificationStatus = 'Not Qualified';
                }

                $dogImageStmt = $conn->prepare("SELECT dog_image FROM dogs_tbl WHERE name = :dogName AND age = :dogAge AND color = :dogColor");
                $dogImageStmt->bindParam(':dogName', $dogName);
                $dogImageStmt->bindParam(':dogAge', $dogAge);
                $dogImageStmt->bindParam(':dogColor', $dogColor);
                $dogImageStmt->execute();
                $dogImageRow = $dogImageStmt->fetch(PDO::FETCH_ASSOC);

                if ($dogImageRow) {
                    $dogImage = $dogImageRow['dog_image'];
                } else {
                    $dogImage = '/uploads/default_dog.jpg';
                }

                $stmt = $conn->prepare("INSERT INTO application_table 
                   (schedule, username, dog_name, dog_age, dog_color, dog_gender, name, age, birthdate, address, sex, citizenship, contact, 
                   spouse, children, reason, employment_status, income_source, monthly_income, veterinarian, pets, Qualified, dog_image, valid_id)
                   VALUES 
                   (:schedule,:username, :dogName, :dogAge, :dogColor, :dogGender, :name, :age, :birthdate, :address, :sex, :citizenship, :contact, 
                   :spouse, :children, :reason, :employmentStatus, :incomeSource, :monthlyIncome, :veterinarian, :pets, :qualificationStatus, :dogImage, :validId)");

                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':schedule', $schedule);
                $stmt->bindParam(':dogName', $dogName);
                $stmt->bindParam(':dogAge', $dogAge);
                $stmt->bindParam(':dogColor', $dogColor);
                $stmt->bindParam(':dogGender', $dogGender);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':age', $age);
                $stmt->bindParam(':birthdate', $birthdate);
                $stmt->bindParam(':address', $address);
                $stmt->bindParam(':sex', $sex);
                $stmt->bindParam(':citizenship', $citizenship);
                $stmt->bindParam(':contact', $contact);
                $stmt->bindParam(':spouse', $spouse);
                $stmt->bindParam(':children', $children);
                $stmt->bindParam(':reason', $reasonForAdoption);
                $stmt->bindParam(':employmentStatus', $employmentStatus);
                $stmt->bindParam(':incomeSource', $incomeSource);
                $stmt->bindParam(':monthlyIncome', $monthlyIncome);
                $stmt->bindParam(':veterinarian', $veterinarian);
                $stmt->bindParam(':pets', $pets);
                $stmt->bindParam(':qualificationStatus', $qualificationStatus);
                $stmt->bindParam(':dogImage', $dogImage);
                $stmt->bindParam(':validId', $newImageName);

                try {
                    $stmt->execute();

                    if ($qualificationStatus === 'Not Qualified') {
                        $unqualifiedStmt = $conn->prepare("INSERT INTO notqualified_tbl 
                                                          (schedule, username, dog_name, dog_age, dog_color, dog_gender, name, age, birthdate, address, sex, citizenship, contact, 
                                                          spouse, children, reason, employment_status, income_source, monthly_income, 
                                                          veterinarian, pets, Qualified, valid_id)
                                                          VALUES 
                                                          (:schedule, :username, :dogName, :dogAge, :dogColor, :dogGender, :name, :age, :birthdate, :address, :sex, :citizenship, :contact, 
                                                          :spouse, :children, :reason, :employmentStatus, :incomeSource, :monthlyIncome, 
                                                          :veterinarian, :pets, :qualificationStatus, :validId)");

                        $unqualifiedStmt->bindParam(':username', $username);
                        $unqualifiedStmt->bindParam(':schedule', $schedule);
                        $unqualifiedStmt->bindParam(':dogName', $dogName);
                        $unqualifiedStmt->bindParam(':dogAge', $dogAge);
                        $unqualifiedStmt->bindParam(':dogColor', $dogColor);
                        $unqualifiedStmt->bindParam(':dogGender', $dogGender);
                        $unqualifiedStmt->bindParam(':name', $name);
                        $unqualifiedStmt->bindParam(':age', $age);
                        $unqualifiedStmt->bindParam(':birthdate', $birthdate);
                        $unqualifiedStmt->bindParam(':address', $address);
                        $unqualifiedStmt->bindParam(':sex', $sex);
                        $unqualifiedStmt->bindParam(':citizenship', $citizenship);
                        $unqualifiedStmt->bindParam(':contact', $contact);
                        $unqualifiedStmt->bindParam(':spouse', $spouse);
                        $unqualifiedStmt->bindParam(':children', $children);
                        $unqualifiedStmt->bindParam(':reason', $reasonForAdoption);
                        $unqualifiedStmt->bindParam(':employmentStatus', $employmentStatus);
                        $unqualifiedStmt->bindParam(':incomeSource', $incomeSource);
                        $unqualifiedStmt->bindParam(':monthlyIncome', $monthlyIncome);
                        $unqualifiedStmt->bindParam(':veterinarian', $veterinarian);
                        $unqualifiedStmt->bindParam(':pets', $pets);
                        $unqualifiedStmt->bindParam(':qualificationStatus', $qualificationStatus);
                        $unqualifiedStmt->bindParam(':validId', $newImageName);

                        $unqualifiedStmt->execute();
                    } else {
                        $qualifiedStmt = $conn->prepare("INSERT INTO qualified_table 
                                                        (schedule, username, dog_name, dog_age, dog_color, dog_gender, name, age, birthdate, address, sex, citizenship, contact, 
                                                        spouse, children, reason, employment_status, income_source, monthly_income, 
                                                        veterinarian, pets, Qualified, valid_id)
                                                        VALUES 
                                                        (:schedule, :username, :dogName, :dogAge, :dogColor, :dogGender, :name, :age, :birthdate, :address, :sex, :citizenship, :contact, 
                                                        :spouse, :children, :reason, :employmentStatus, :incomeSource, :monthlyIncome, 
                                                        :veterinarian, :pets, :qualificationStatus, :validId)");

                        $qualifiedStmt->bindParam(':username', $username);
                        $qualifiedStmt->bindParam(':schedule', $schedule);
                        $qualifiedStmt->bindParam(':dogName', $dogName);
                        $qualifiedStmt->bindParam(':dogAge', $dogAge);
                        $qualifiedStmt->bindParam(':dogColor', $dogColor);
                        $qualifiedStmt->bindParam(':dogGender', $dogGender);
                        $qualifiedStmt->bindParam(':name', $name);
                        $qualifiedStmt->bindParam(':age', $age);
                        $qualifiedStmt->bindParam(':birthdate', $birthdate);
                        $qualifiedStmt->bindParam(':address', $address);
                        $qualifiedStmt->bindParam(':sex', $sex);
                        $qualifiedStmt->bindParam(':citizenship', $citizenship);
                        $qualifiedStmt->bindParam(':contact', $contact);
                        $qualifiedStmt->bindParam(':spouse', $spouse);
                        $qualifiedStmt->bindParam(':children', $children);
                        $qualifiedStmt->bindParam(':reason', $reasonForAdoption);
                        $qualifiedStmt->bindParam(':employmentStatus', $employmentStatus);
                        $qualifiedStmt->bindParam(':incomeSource', $incomeSource);
                        $qualifiedStmt->bindParam(':monthlyIncome', $monthlyIncome);
                        $qualifiedStmt->bindParam(':veterinarian', $veterinarian);
                        $qualifiedStmt->bindParam(':pets', $pets);
                        $qualifiedStmt->bindParam(':qualificationStatus', $qualificationStatus);
                        $qualifiedStmt->bindParam(':validId', $newImageName);

                        $qualifiedStmt->execute();
                    }

                    header("Location: pendingPage.php");
                    exit;
                } catch(PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            } else {
                echo "<script>alert('Error moving uploaded file.');</script>";
            }
        }
    }
}
?>
