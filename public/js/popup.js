   function openSliderModal(type) {
            closeSliderModals();
            const modalId = {
                create: 'sliderCreateModal',
                edit: 'sliderEditModal',
                delete: 'sliderDeleteModal'
            } [type];

            if (modalId) {
                document.getElementById(modalId).classList.add('active');
            }
        }

        function closeSliderModals() {
            document.querySelectorAll('.slider-modal-overlay').forEach(modal => {
                modal.classList.remove('active');
            });
        }

        document.querySelectorAll('.slider-modal-overlay').forEach(overlay => {
            overlay.addEventListener('click', function(e) {
                if (e.target === overlay) closeSliderModals();
            });
        });