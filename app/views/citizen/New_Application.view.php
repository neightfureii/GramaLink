<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Application</title>

    <!-- Iconscout CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    
    <!-- Montserrat Font(Google fonts) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?=ROOT?>/assets/css/citizen/new_application.css"> 
</head>
<body>
    <?php include '../app/views/citizen/partials/navbar.php'; ?>

    <!-- Breadcrumb Section -->
    <div class="container breadcrumb">
        <p><a href="home" class="crumb">Home</a> > <a href="dashboard" class="crumb">Dashboard</a> > <a href="application" class="crumb">Applications and Certifications</a> > <a href="new_application" class="crumb">New Application</a></p>
    </div>

    <div class="container wrapper">

        <h2>Certificate Request Application</h2>

        <form id="documentRequestForm" method="post">
            <div class="form-group">
                <!-- Common Details -->
                <label for="fullName">Full Name:</label>
                <input type="text" id="fullName" name="fullName" value="<?=htmlspecialchars($userDetails->full_name)?>" readonly><br>
            </div>
            
            <div class="form-group">
                <label for="nic">NIC Number:</label>
                <input type="text" id="nic" name="nic" value="<?=htmlspecialchars($userDetails->nic)?>" readonly><br>
            </div>
            
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" value="<?=htmlspecialchars($userDetails->address)?>" readonly><br>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="text" id="phone" name="phone" value="<?=htmlspecialchars($userDetails->mobileNumber)?>" readonly><br>
            </div>

            <div class="form-group">
                <!-- Document Selection -->
                <label for="documentType">Select Application Type:</label>
                <select id="documentType" name="documentType" required>
                    <option value="">-- Select --</option>
                    <option value="residence">Resident Certificate</option>
                    <option value="character">Character Certificate</option>
                    <option value="incomeCertificate">Income Certificate</option>
                    <option value="publicAid">Public Aid</option>
                    <option value="electricityWater">Electricity & Water Connection</option>
                    <option value="criminalBgCheck">Criminal Background Check Reports</option>
                    <option value="deathCertificate">Death Report Certification</option>
                    <option value="valuationCertificate">Valuation Certificate</option>
                    <option value="idApplication">Identity Card Application</option>
                    <option value="landOwnership">Land Ownership Assessment</option>
                </select>
            </div>

            <!-- Document Specific Fields -->
            <div id="residenceFields" class="form-group hidden">
                <label for="residenceyearsLived">Years Lived at Current Address:</label>
                <input type="number" id="residenceyearsLived" name="residenceyearsLived"><br>

                <label for="residenceReason">Reason for request:</label>
                <select id="residenceReason" name="residenceReason">
                    <option value="">-- Select --</option>
                    <option value="job">Job</option>
                    <option value="schooladmission">School Admission</option>
                    <option value="travel">Travel</option>
                    <option value="other">Other</option>
                </select><br>
            </div>

            <div id="characterFields" class="form-group hidden">
                <label for="characteryearsLived">Years Lived at Current Address:</label>
                <input type="number" id="characteryearsLived" name="characteryearsLived"><br>
                
                <label for="characterOccupation">Occupation:</label>
                <input type="text" id="characterOccupation" name="characterOccupation"><br>

                <label for="characterInstitute">Institute Requesting the Certificate:</label>
                <input type="text" id="characterInstitute" name="characterInstitute"><br>

                <label for="characterReason">Reason for request:</label>
                <select id="characterReason" name="characterReason">
                    <option value="">-- Select --</option>
                    <option value="employment">Employment</option>
                    <option value="visa">Visa</option>
                    <option value="other">Other</option>
                </select><br>
            </div>
            
            <div id="incomeCertificateFields" class="form-group hidden">
                <label for="incomeIncome">Monthly Income:</label>
                <input type="number" id="incomeIncome" name="incomeIncome"><br>

                <label for="occupation">Occupation:</label>
                <input type="text" id="occupation" name="occupation"><br>

                <label for="incomeSource">Source(s) of Income:</label>
                <select id="incomeSource" name="incomeSource">
                    <option value="">-- Select --</option>
                    <option value="job">Job</option>
                    <option value="business">Business</option>
                    <option value="agriculture">Agriculture</option>
                    <option value="other">Other</option>
                </select><br>

                <label for="incomeReason">Reason for Request:</label>
                <select id="incomeReason" name="incomeReason">
                    <option value="">-- Select --</option>
                    <option value="university_application">University Application</option>
                    <option value="welfare">Welfare</option>
                    <option value="other">Other</option>
                </select><br>
            </div>

            <div id="publicAidFields" class="form-group hidden">
                <label for="publicAidReason">Reason for Request:</label>
                <select id="publicAidReason" name="publicAidReason">
                    <option value="">-- Select --</option>
                    <option value="samurdhi">Samurdhi</option>
                    <option value="school_books">School Books/Uniforms</option>
                    <option value="disability">Disability Aid</option>
                    <option value="other">Other</option>
                </select><br>

                <label for="publicAidFamilySize">Number of Family Members:</label>
                <input type="number" id="publicAidFamilySize" name="publicAidFamilySize"><br>

                <label for="publicAidIncome">Total Monthly Household Income:</label>
                <input type="number" id="publicAidIncome" name="publicAidIncome"><br>
            </div>

            <div id="electricityWaterFields" class="form-group hidden">
                <label for="ewConnectionType">Type of Connection:</label>
                <select id="ewConnectionType" name="ewConnectionType">
                    <option value="">-- Select --</option>
                    <option value="electricity">Electricity</option>
                    <option value="water">Water</option>
                    <option value="both">Both</option>
                </select><br>

                <label for="ewOwnership">Are you the land/property owner?</label>
                <select id="ewOwnership" name="ewOwnership">
                    <option value="">-- Select --</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select><br>

                <label for="ewReason">Reason for Request:</label>
                <input type="text" id="ewReason" name="ewReason"><br>
            </div>

            <div id="criminalBgCheckFields" class="form-group hidden">
                <label for="cbcOccupation">Occupation:</label>
                <input type="text" id="cbcOccupation" name="cbcOccupation"><br>

                <label for="cbcInstitution">Institution Requesting the Report:</label>
                <input type="text" id="cbcInstitution" name="cbcInstitution"><br>

                <label for="cbcReason">Purpose:</label>
                <select id="cbcReason" name="cbcReason">
                    <option value="">-- Select --</option>
                    <option value="employment">Employment</option>
                    <option value="visa">Visa</option>
                    <option value="other">Other</option>
                </select><br>
            </div>

            <div id="deathCertificateFields" class="form-group hidden">
                <label for="deceasedName">Full Name of Deceased:</label>
                <input type="text" id="deceasedName" name="deceasedName"><br>

                <label for="deceasedNIC">NIC of Deceased (if available):</label>
                <input type="text" id="deceasedNIC" name="deceasedNIC"><br>

                <label for="deceasedDate">Date of Death:</label>
                <input type="date" id="deceasedDate" name="deceasedDate"><br>

                <label for="relationship">Your Relationship to the Deceased:</label>
                <input type="text" id="relationship" name="relationship"><br>
            </div>

            <div id="landOwnershipFields" class="form-group hidden">
                <label for="landAddress">Address of the Land:</label>
                <input type="text" id="landAddress" name="landAddress"><br>

                <label for="landSize">Land Size (in Perches/Acres):</label>
                <input type="text" id="landSize" name="landSize"><br>

                <label for="landYearsLived">Years Occupied / Resided:</label>
                <input type="number" id="landYearsLived" name="landYearsLived"><br>

                <label for="landDocumentType">Type of Document Possessed:</label>
                <select id="landDocumentType" name="landDocumentType">
                    <option value="">-- Select --</option>
                    <option value="deed">Deed</option>
                    <option value="permit">Permit</option>
                    <option value="other">Other</option>
                    <option value="none">None</option>
                </select><br>

                <label for="landPurpose">Purpose of Request:</label>
                <select id="landPurpose" name="landPurpose">
                    <option value="">-- Select --</option>
                    <option value="legal">Legal Proof</option>
                    <option value="government_aid">Government Aid</option>
                    <option value="boundary_conflict">Boundary Conflict</option>
                    <option value="other">Other</option>
                </select><br>
            </div>


            <div id="valuationCertificateFields" class="form-group hidden">
                <label for="valuationLandAddress">Address of the Property:</label>
                <input type="text" id="valuationLandAddress" name="valuationLandAddress"><br>

                <label for="valuationOwnership">Are you the owner of this property?</label>
                <select id="valuationOwnership" name="valuationOwnership">
                    <option value="">-- Select --</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select><br>

                <label for="valuationPurpose">Purpose of Valuation:</label>
                <select id="valuationPurpose" name="valuationPurpose">
                    <option value="">-- Select --</option>
                    <option value="loan">Bank Loan</option>
                    <option value="sale">Sale</option>
                    <option value="legal">Legal Process</option>
                    <option value="other">Other</option>
                </select><br>
            </div>

            <div id="idApplicationFields" class="form-group hidden">
                <label for="idApplicantDOB">Date of Birth:</label>
                <input type="date" id="idApplicantDOB" name="idApplicantDOB" value="<?= $userDetails->date_of_birth ?>"><br>

                <label for="idApplicantGender">Gender:</label>
                <select id="idApplicantGender" name="idApplicantGender">
                    <option value="">-- Select --</option>
                    <option value="male" <?= $userDetails->gender == 'male' ? 'selected' : '' ?>>Male</option>
                    <option value="female" <?= $userDetails->gender == 'female' ? 'selected' : '' ?>>Female</option>
                    <option value="other" <?= $userDetails->gender == 'other' ? 'selected' : '' ?>>Other</option>
                </select><br>

                <label for="idBirthCertificate">Birth Certificate Number:</label>
                <input type="text" id="idBirthCertificate" name="idBirthCertificate" value="<?= $userDetails->bcnumber ?>"><br>

                <label for="idReason">Reason for Request:</label>
                <select id="idReason" name="idReason">
                    <option value="">-- Select --</option>
                    <option value="first">First ID Application</option>
                    <option value="lost">Lost ID</option>
                    <option value="damaged">Damaged ID</option>
                </select><br>
            </div>

            
            <button type="submit" class="submit_new_application">Submit Request</button>
        </form>

    </div>

    <script>
        const documentTypeSelect = document.getElementById("documentType");

        documentTypeSelect.addEventListener("change", function() {
            // First, hide all and remove "required" attributes
            document.querySelectorAll(".hidden").forEach(el => {
                el.style.display = "none";
                el.querySelectorAll("input, select").forEach(input => {
                    input.required = false;
                });
            });

            // Then show selected fields and make their inputs/selects required
            const selectedType = this.value;
            if (selectedType) {
                const fieldsSection = document.getElementById(selectedType + "Fields");
                if (fieldsSection) {
                    fieldsSection.style.display = "block";
                    fieldsSection.querySelectorAll("input, select").forEach(input => {
                        input.required = true;
                    });
                }
            }
        });
    </script>


    <?php include '../app/views/citizen/partials/footer.php'; ?>

    <script src="<?=ROOT?>/assets/js/citizen/main.js"></script>
</body>
</html>

