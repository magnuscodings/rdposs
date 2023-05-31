const dragDropArea = document.getElementById("drag-drop-area");
const fileInput = document.getElementById("file-input");
let filesToUpload;

dragDropArea.addEventListener("dragover", (e) => {
  e.preventDefault();
  dragDropArea.classList.add("highlight");
});

dragDropArea.addEventListener("dragleave", () => {
  dragDropArea.classList.remove("highlight");
});

dragDropArea.addEventListener("drop", (e) => {
  e.preventDefault();
  dragDropArea.classList.remove("highlight");

  const files = e.dataTransfer.files;
  if (files.length > 0) {
    filesToUpload = files;
    handleFileUpload(filesToUpload);
  }
});

fileInput.addEventListener("change", (e) => {
  const files = e.target.files;
  filesToUpload = files;
  handleFileUpload(filesToUpload);
});

function handleFileUpload(files) {
  if (files.length > 0) {
    // Dito mo maiproseso ang mga file tulad ng pag-save sa server o iba pang mga pag-andar ng iyong aplikasyon.
    console.log(files);
  }
}
