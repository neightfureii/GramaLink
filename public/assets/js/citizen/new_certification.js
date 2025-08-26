 // Function to handle dropdown change and form display
 function displaySelectedForm() {
    const dropdown = document.getElementById("formTypeDropdown");
    const formType = dropdown.value;
    const formContainer = document.getElementById("formContainer");
  
    let formHtml = "";
  
    if (formType === "") {
      formContainer.innerHTML = "<h3>Select a form to fill out</h3>";
      return;
    }
  
    // Show the selected form based on the dropdown value
    switch (formType) {
      case "residence-certification":
        formHtml = `
        <main class="form">
          <section class="form-section">
              <div class="form-container">
                  <div class="form-sidebar">
                      <h2>Residence Certification</h2>
                  </div>
                  <div class="form-content">
                      <h3>Please fill out this form:</h3>
                      <form>
                          <div class="form-group">
                              <label for="nicNumber">NIC Number:</label>
                              <input type="text" id="nicNumber" name="nicNumber" placeholder="Enter your NIC Number"
                                  required>
                          </div>
  
                          <div class="form-group">
                              <label for="fullName">Full Name:</label>
                              <input type="text" id="fullName" name="fullName" placeholder="Enter your Full Name"
                                  required>
                          </div>
  
                          <div class="form-group">
                              <label for="initialName">Name With Initial:</label>
                              <input type="text" id="initialName" name="initialName"
                                  placeholder="Enter your Name with Initial" required>
                          </div>
  
                          <div class="form-group">
                              <label for="address">Address:</label>
                              <textarea id="address" name="address" placeholder="Enter your Address" required></textarea>
                          </div>
  
                          <div class="form-group">
                              <label for="nod">Land Deed Number:</label>
                              <input type="text" id="nod" name="nod" required>
                          </div>
  
                          <div class="form-group">
                              <label for="dol">Date of occupancy of the land:</label>
                              <input type="date" id="dol" name="dol" required>
                          </div>
  
  
                          <div class="form-group">
                              <button type="submit">Submit</button>
                          </div>
                      </form>
                  </div>
              </div>
          </section>
      </main>
              `;
        break;
      case "samurdhi-certification":
        formHtml = `
                  <main class="form">
          <section class="form-section">
              <div class="form-container">
                  <div class="form-sidebar">
                      <h2>Samurdhi Certification</h2>
                  </div>
                  <div class="form-content">
                      <h3>Please fill out this form:</h3>
                      <form>
                          <div class="form-group">
                              <label for="nicNumber">NIC Number:</label>
                              <input type="text" id="nicNumber" name="nicNumber" placeholder="Enter your NIC Number"
                                  required>
                          </div>
  
                          <div class="form-group">
                              <label for="fullName">Full Name:</label>
                              <input type="text" id="fullName" name="fullName" placeholder="Enter your Full Name"
                                  required>
                          </div>
  
                          <div class="form-group">
                              <label for="initialName">Name With Initial:</label>
                              <input type="text" id="initialName" name="initialName"
                                  placeholder="Enter your Name with Initial" required>
                          </div>
  
                          <div class="form-group">
                              <label for="address">Address:</label>
                              <textarea id="address" name="address" placeholder="Enter your Address" required></textarea>
                          </div>
  
                          <div class="form-group">
                              <label for="dob">Birthday:</label>
                              <input type="date" id="dob" name="dob" required>
                          </div>
  
                          <div class="form-group">
                              <label for="nom">Number of Members in the family:</label>
                              <input type="text" id="nom" name="nom" required>
                          </div>
  
                          <div class="form-group">
                              <label for="nos">Number of Children going to school:</label>
                              <input type="text" id="nos" name="nos" required>
                          </div>
  
                          <div class="form-group">
                              <label for="noh">Number of Children studying Higher Education:</label>
                              <input type="text" id="noh" name="noh" required>
                          </div>
  
                          <div class="form-group">
                              <label for="job">Applicant's Occupation:</label>
                              <input type="text" id="job" name="job" required>
                          </div>
  
                          <div class="form-group">
                              <label for="inc">Family Annual Income(Rs:):</label>
                              <input type="text" id="inc" name="inc" required>
                          </div>
  
                          <div class="form-group">
                              <button type="submit">Submit</button>
                          </div>
                      </form>
                  </div>
              </div>
          </section>
      </main>
              `;
        break;
      case "income-certification":
        formHtml = `
                  <main class="form">
          <section class="form-section">
              <div class="form-container">
                  <div class="form-sidebar">
                      <h2>Income Certification</h2>
                  </div>
                  <div class="form-content">
                      <h3>Please fill out this form:</h3>
                      <form>
                          <div class="form-group">
                              <label for="nicNumber">NIC Number:</label>
                              <input type="text" id="nicNumber" name="nicNumber" placeholder="Enter your NIC Number"
                                  required>
                          </div>
  
                          <div class="form-group">
                              <label for="fullName">Full Name:</label>
                              <input type="text" id="fullName" name="fullName" placeholder="Enter your Full Name"
                                  required>
                          </div>
  
                          <div class="form-group">
                              <label for="initialName">Name With Initial:</label>
                              <input type="text" id="initialName" name="initialName"
                                  placeholder="Enter your Name with Initial" required>
                          </div>
  
                          <div class="form-group">
                              <label for="address">Address:</label>
                              <textarea id="address" name="address" placeholder="Enter your Address" required></textarea>
                          </div>
  
                          <div class="form-group">
                              <label for="dob">Birthday:</label>
                              <input type="date" id="dob" name="dob" required>
                          </div>
  
                          <div class="form-group">
                              <label for="job">Applicant's Occupation:</label>
                              <input type="text" id="job" name="job" required>
                          </div>
  
                          <div class="form-group">
                              <label for="ms">Applicant's Monthly Salary:</label>
                              <input type="text" id="ms" name="ms" required>
                          </div>
  
                          <div class="form-group">
                              <label for="oth">Other Sources of Income:</label>
                              <textarea id="oth" name="oth" required></textarea>
                          </div>
  
                          <div class="form-group">
                              <label for="inoth">Annual Income form Other Sources of Income:</label>
                              <input type="text" id="inoth" name="inoth" required>
                          </div>
  
                          <div class="form-group">
                              <label for="tot">Total Annual Income:</label>
                              <input type="text" id="tot" name="tot" required>
                          </div>
  
                          <div class="form-group">
                              <button type="submit">Submit</button>
                          </div>
                      </form>
                  </div>
              </div>
          </section>
      </main>
              `;
        break;
      case "widow-certification":
        formHtml = `
                  <main class="form">
          <section class="form-section">
              <div class="form-container">
                  <div class="form-sidebar">
                      <h2>Widow/Widower Certification</h2>
                  </div>
                  <div class="form-content">
                      <h3>Please fill out this form:</h3>
                      <form>
                          <div class="form-group">
                              <label for="nicNumber">NIC Number:</label>
                              <input type="text" id="nicNumber" name="nicNumber" placeholder="Enter your NIC Number"
                                  required>
                          </div>
  
                          <div class="form-group">
                              <label for="fullName">Full Name:</label>
                              <input type="text" id="fullName" name="fullName" placeholder="Enter your Full Name"
                                  required>
                          </div>
  
                          <div class="form-group">
                              <label for="initialName">Name With Initial:</label>
                              <input type="text" id="initialName" name="initialName"
                                  placeholder="Enter your Name with Initial" required>
                          </div>
  
                          <div class="form-group">
                              <label for="address">Address:</label>
                              <textarea id="address" name="address" placeholder="Enter your Address" required></textarea>
                          </div>
  
                          <div class="form-group">
                              <label for="chd">Cause of his/her Death:</label>
                              <textarea id="chd" name="chd" required></textarea>
                          </div>
  
                          <div class="form-group">
                              <label for="dod">Date of his/her Death:</label>
                              <input type="date" id="dod" name="dod" required></input>
                          </div>
  
                          <div class="form-group">
                              <label for="noc">Number of Children:</label>
                              <input type="text" id="noc" name="noc" required></input>
                          </div>
  
  
                          <div class="form-group">
                              <button type="submit">Submit</button>
                          </div>
                      </form>
                  </div>
              </div>
          </section>
      </main>
              `;
        break;
      case "poverty-certification":
        formHtml = `
                  <main class="form">
          <section class="form-section">
              <div class="form-container">
                  <div class="form-sidebar">
                      <h2>Poverty Certification</h2>
                  </div>
                  <div class="form-content">
                      <h3>Please fill out this form:</h3>
                      <form>
                          <div class="form-group">
                              <label for="nicNumber">NIC Number:</label>
                              <input type="text" id="nicNumber" name="nicNumber" placeholder="Enter your NIC Number"
                                  required>
                          </div>
  
                          <div class="form-group">
                              <label for="fullName">Full Name:</label>
                              <input type="text" id="fullName" name="fullName" placeholder="Enter your Full Name"
                                  required>
                          </div>
  
                          <div class="form-group">
                              <label for="initialName">Name With Initial:</label>
                              <input type="text" id="initialName" name="initialName"
                                  placeholder="Enter your Name with Initial" required>
                          </div>
  
                          <div class="form-group">
                              <label for="address">Address:</label>
                              <textarea id="address" name="address" placeholder="Enter your Address" required></textarea>
                          </div>
  
                          <div class="form-group">
                              <label for="nom">Number of Members in the family:</label>
                              <input type="text" id="nom" name="nom" required>
                          </div>
  
                          <div class="form-group">
                              <label for="nos">Number of Children going to school:</label>
                              <input type="text" id="nos" name="nos" required>
                          </div>
  
                          <div class="form-group">
                              <label for="noh">Number of Children studying Higher Education:</label>
                              <input type="text" id="noh" name="noh" required>
                          </div>
  
                          <div class="form-group">
                              <label for="pro">Are Children entitled to student allowances?:</label>
                              <input type="text" id="pro" name="pro" required>
                          </div>
  
  
                          <div class="form-group">
                              <label for="job">Applicant's Occupation:</label>
                              <input type="text" id="job" name="job" required>
                          </div>
  
                          <div class="form-group">
                              <label for="inc">Family Annual Income(Rs:):</label>
                              <input type="text" id="inc" name="inc" required>
                          </div>
  
                          <div class="form-group">
                              <label for="grc">Family Monthly gross cost(Rs:):</label>
                              <input type="text" id="grc" name="grc" required>
                          </div>
  
  
                          
  
                          <div class="form-group">
                              <button type="submit">Submit</button>
                          </div>
                      </form>
                  </div>
              </div>
          </section>
      </main>
              `;
        break;
      case "land-certification":
        formHtml = `
                  <main class="form">
          <section class="form-section">
              <div class="form-container">
                  <div class="form-sidebar">
                      <h2>Land Ownership Certification</h2>
                  </div>
                  <div class="form-content">
                      <h3>Please fill out this form:</h3>
                      <form>
                          <div class="form-group">
                              <label for="nicNumber">NIC Number:</label>
                              <input type="text" id="nicNumber" name="nicNumber" placeholder="Enter your NIC Number"
                                  required>
                          </div>
  
                          <div class="form-group">
                              <label for="fullName">Full Name:</label>
                              <input type="text" id="fullName" name="fullName" placeholder="Enter your Full Name"
                                  required>
                          </div>
  
                          <div class="form-group">
                              <label for="initialName">Name With Initial:</label>
                              <input type="text" id="initialName" name="initialName"
                                  placeholder="Enter your Name with Initial" required>
                          </div>
  
                          <div class="form-group">
                              <label for="address">Address:</label>
                              <textarea id="address" name="address" placeholder="Enter your Address" required></textarea>
                          </div>
  
                          <div class="form-group">
                              <label for="sol">Size of land:</label>
                              <input type="text" id="sol" name="sol" required>
                          </div>
  
                          <div class="form-group">
                              <label for="nol">Nature of land:</label>
                              <input type="text" id="nol" name="nol" required>
                          </div>
  
                          <div class="form-group">
                              <button type="submit">Submit</button>
                          </div>
                      </form>
                  </div>
              </div>
          </section>
      </main>
              `;
        break;
      default:
        formHtml = "<h3>Select a form to fill out</h3>";
    }
  
    formContainer.innerHTML = formHtml;
  }
  