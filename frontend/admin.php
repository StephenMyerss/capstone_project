<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <title>Admin</title>
</head>
<body>
    <div class="container">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom border-dark">
            <div class="d-flex align-items-center mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <img class="innovation-logo" src="../innovationImages/Screenshot%202024-02-20%20at%208.29.06%E2%80%AFPM.png" alt="">
            </div>
            <div class="text-center justify-content-center border-dark">
                <h1 class="display-4 fw-bold text-body-emphasis">Admin Page</h1>
              </div>
        </header>
    </div>

    <div class="container fs-4 mt-5">
        <h2 class="mb-4 display-5 fw-bold">User Posts</h2>
        <div class="mb-3">
          <label for="filterDate">Filter by Date:</label>
          <div class="input-group">
            <input type="date" id="filterDate" class="form-control fs-4">
            <div class="input-group-append">
              <button class="fs-4 btn button-color" type="button" id="clearDateBtn">Clear</button>
            </div>
          </div>
        </div>
        <div class="mb-3">
          <label for="keywordSearch">Keyword Search:</label>
          <div class="input-group">
            <input type="text" id="keywordSearch" class="form-control fs-4">
            <div class="input-group-append">
              <button class="fs-4 btn button-color" type="button" id="clearKeywordBtn">Clear</button>
            </div>
          </div>
        </div>
        <div id="postList" class="list-group">
          <!-- Posts will be dynamically populated here -->
        </div>
      </div>
    
      <!-- Bootstrap JS (Optional, if needed) -->
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <script>
        // Example data - replace with actual data retrieved from the backend
        const posts = [
          { id: 1, title: "First Post", content: "This is the first post by a user.", dateSubmitted: "2024-02-01" },
          { id: 2, title: "Second Post", content: "This is the second post by a user.", dateSubmitted: "2024-02-10" },
          { id: 3, title: "Third Post", content: "This is the third post by a user.", dateSubmitted: "2024-02-15" }
        ];
    
        // Function to render posts based on filter inputs
        function renderPosts() {
          const filterDate = document.getElementById('filterDate').value;
          const keyword = document.getElementById('keywordSearch').value.toLowerCase();
    
          const postList = document.getElementById('postList');
          postList.innerHTML = '';
    
          posts.forEach(post => {
            if ((!filterDate || post.dateSubmitted === filterDate) && (!keyword || post.title.toLowerCase().includes(keyword) || post.content.toLowerCase().includes(keyword))) {
              const postItem = `
                <a href="#" class="list-group-item list-group-item-action">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">${post.title}</h5>
                    <small class="text-muted">Date Submitted: ${post.dateSubmitted}</small>
                  </div>
                  <p class="mb-1">${post.content}</p>
                </a>`;
              postList.insertAdjacentHTML('beforeend', postItem);
            }
          });
        }
    
        // Call renderPosts function when the page loads and when the filter inputs change
        document.addEventListener('DOMContentLoaded', () => {
          renderPosts();
          document.getElementById('filterDate').addEventListener('change', renderPosts);
          document.getElementById('keywordSearch').addEventListener('input', renderPosts);
          document.getElementById('clearDateBtn').addEventListener('click', () => {
            document.getElementById('filterDate').value = '';
            renderPosts();
          });
          document.getElementById('clearKeywordBtn').addEventListener('click', () => {
            document.getElementById('keywordSearch').value = '';
            renderPosts();
          });
        });
      </script>
    
      

    <div class="container">
        <footer class="py-3 my-4 border-top border-dark">
            <p class="text-center text-body-secondary">© 2024 Cameron University Capstone</p>
        </footer>
    </div>
    
</body>
</html>