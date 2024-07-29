const uploadForm = document.querySelector('.upload-form');
const artworkInput = document.getElementById('artwork');
const descriptionInput = document.getElementById('description');

uploadForm.addEventListener('submit', (event) => {
  event.preventDefault(); // Prevent form submission

  const formData = new FormData();
  formData.append('artwork', artworkInput.files[0]);
  formData.append('description', descriptionInput.value);

  // Handle image upload using fetch or XMLHttpRequest
  fetch('upload.php', {
    method: 'POST',
    body: formData
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    return response.json();
  })
  .then(data => {
    // Handle successful upload response
    console.log(data);
    // Display success message or redirect to another page
  })
  .catch(error => {
    // Handle upload error
    console.error('Error uploading image:', error);
    // Display error message to user
  });
});
