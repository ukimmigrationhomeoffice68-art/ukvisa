<!-- Photo crop modal -->
<div id="cropModal" class="hidden fixed inset-0 z-50 items-center justify-center bg-black/60 p-4">
  <div class="bg-white rounded max-w-2xl w-full p-6">
    <h2 class="text-[24px] font-bold text-greenwebproject-black mb-4">Crop photo</h2>
    <div class="max-h-[60vh] overflow-hidden bg-greenwebproject-light-grey">
      <img id="cropImage" src="" alt="Image to crop" class="max-w-full block">
    </div>
    <p class="text-[14px] text-greenwebproject-grey mt-3">Drag to reposition and use the corners to resize. The crop is locked to a passport-photo ratio.</p>
    <div class="flex gap-4 mt-5">
      <button type="button" id="cropApply" class="bg-greenwebproject-blue hover:bg-greenwebproject-dark-blue text-white font-bold py-2 px-6 rounded">Apply crop</button>
      <button type="button" id="cropCancel" class="bg-greenwebproject-mid-grey hover:bg-greenwebproject-grey text-white font-bold py-2 px-6 rounded">Cancel</button>
    </div>
  </div>
</div>

<script>
(function () {
  var fileInput   = document.querySelector('[data-photo-input]');
  var croppedField = document.querySelector('[data-photo-cropped]');
  var previewWrap = document.querySelector('[data-photo-preview-wrap]');
  var preview     = document.querySelector('[data-photo-preview]');
  var modal       = document.getElementById('cropModal');
  var image       = document.getElementById('cropImage');
  var applyBtn    = document.getElementById('cropApply');
  var cancelBtn   = document.getElementById('cropCancel');
  var cropper     = null;

  if (!fileInput || typeof Cropper === 'undefined') return;

  function openModal() {
    modal.classList.remove('hidden');
    modal.classList.add('flex');
  }
  function closeModal() {
    if (cropper) { cropper.destroy(); cropper = null; }
    modal.classList.add('hidden');
    modal.classList.remove('flex');
  }

  fileInput.addEventListener('change', function (e) {
    var file = e.target.files && e.target.files[0];
    if (!file) return;

    if (file.size > 10 * 1024 * 1024) {
      alert('Selected file is too large. Please select an image under 10MB to crop.');
      fileInput.value = '';
      return;
    }

    var reader = new FileReader();
    reader.onload = function (ev) {
      image.src = ev.target.result;
      openModal();
      if (cropper) cropper.destroy();
      cropper = new Cropper(image, {
        aspectRatio: 140 / 175,
        viewMode: 1,
        autoCropArea: 1,
        background: false,
        movable: true,
        zoomable: true,
      });
    };
    reader.readAsDataURL(file);
  });

  applyBtn.addEventListener('click', function () {
    if (!cropper) return;
    var canvas = cropper.getCroppedCanvas({ width: 420, height: 525 });
    var dataUrl = canvas.toDataURL('image/jpeg', 0.85);

    // Ensure cropped image size stays well under 1MB limit
    if (dataUrl.length > 1024 * 1024 * 1.33) {
      dataUrl = canvas.toDataURL('image/jpeg', 0.65);
    }

    croppedField.value = dataUrl;
    preview.src = dataUrl;
    previewWrap.classList.remove('hidden');
    fileInput.value = '';   // submit only the cropped version
    closeModal();
  });

  cancelBtn.addEventListener('click', function () {
    fileInput.value = '';
    closeModal();
  });
})();
</script>
