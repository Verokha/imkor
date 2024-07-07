@vite(["resources/scss/policy.scss"])
<div 
    class="modal micromodal-slide" 
    id="modal-policy" 
    aria-hidden="true"
>
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
      <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-policy-title">
        <div class="modal_header">
            <div class="modal-close" data-micromodal-close>
                <svg width="29" height="29" viewBox="0 0 29 29" fill="none"
                    xmlns="http://www.w3.org/2000/svg" data-micromodal-close >
                    <path d="M2 2L27 27M27 2L2 27" stroke="#0056E8" stroke-width="3" stroke-linecap="round" data-micromodal-close />
                </svg>
            </div>
        </div>
        <div class="modal_property_content">
            <p class="title">Политика конфиденциальности персональной информации</p>
            {!!$text!!}
        </div>
        <div class="button_wrapper">
            <button class="to-contacts" data-micromodal-close>OK</button>
        </div>
      </div>
    </div>
  </div>