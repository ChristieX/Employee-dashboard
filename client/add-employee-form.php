    <?php
    include('../common/connect_db.php');
    $first_name = $last_name = $email = $phone = $dob = $gender = "";
    $first_name_err = $last_name_err = $email_err = $phone_err = $dob_err = $gender_err = "";
    $is_valid = true;
    

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        include('./validation.php');
        validateEmployeeData();
        if ($is_valid) {
            $stmt = $conn->prepare("INSERT INTO employees (first_name, last_name, email, phone, dob, gender) VALUES (?, ?, ?, ?, ?, ?)");

            if ($stmt === false) {
                die("Prepare failed: " . $conn->error);
            }

            $stmt->bind_param("ssssss", $first_name, $last_name, $email, $phone, $dob, $gender);

            if ($stmt->execute()) {
                echo "Employee added successfully.";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
            $conn->close();
        }
    }


    ?>
    <?php include('../common/common_files.php'); ?>
    <?php include('./components/header.php'); ?>
    <?php include('./components/sidebar.php'); ?>
    <div class="container mt-3 ">
        <h2 class="mb-4">Add Employee</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" name="first_name" id="first_name" class="form-control <?php echo $first_name_err ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($first_name); ?>" required>
                    <?php if ($first_name_err): ?>
                        <div class="invalid-feedback d-block"><?php echo $first_name_err; ?></div>
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" name="last_name" id="last_name" class="form-control <?php echo $last_name_err ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($last_name); ?>" required>
                    <?php if ($last_name_err): ?>
                        <div class="invalid-feedback d-block"><?php echo $last_name_err; ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control <?php echo $email_err ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($email); ?>" required>
                    <?php if ($email_err): ?>
                        <div class="invalid-feedback d-block"><?php echo $email_err; ?></div>
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control <?php echo $phone_err ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($phone); ?>" required>
                    <?php if ($phone_err): ?>
                        <div class="invalid-feedback d-block"><?php echo $phone_err; ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="dob" class="form-label">Date of Birth</label>
                    <input type="date" name="dob" id="dob" class="form-control <?php echo $dob_err ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($dob); ?>" required>
                    <?php if ($dob_err): ?>
                        <div class="invalid-feedback d-block"><?php echo $dob_err; ?></div>
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-select" name="gender" id="gender" required class="form-control<?php echo $gender_err ? 'is-invalid' : ''; ?>">
                        <option value="" <?php echo $gender === '' ? 'selected' : ''; ?> disabled>Choose...</option>
                        <option value="M" <?php echo $gender === 'M' ? 'selected' : ''; ?>>Male</option>
                        <option value="F" <?php echo $gender === 'F' ? 'selected' : ''; ?>>Female</option>
                        <option value="O" <?php echo $gender === 'O' ? 'selected' : ''; ?>>Other</option>
                    </select>
                    <?php if ($gender_err): ?>
                        <div class="invalid-feedback d-block"><?php echo $gender_err; ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <button type="submit" name="add-employee" class="btn btn-primary ">Add Employee</button>
        </form>
    </div>