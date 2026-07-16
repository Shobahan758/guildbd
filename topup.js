(() => {
  "use strict";

  document.addEventListener("DOMContentLoaded", () => {
    const paymentInputs = document.querySelectorAll('input[name="payment"]');
    const detailPanels = document.querySelectorAll("[data-payment-panel]");

    function updatePaymentDetails() {
      const selectedPayment = document.querySelector('input[name="payment"]:checked')?.value;

      detailPanels.forEach((panel) => {
        const isActive = panel.dataset.paymentPanel === selectedPayment;
        panel.hidden = !isActive;

        panel.querySelectorAll("input, select, textarea").forEach((field) => {
          field.disabled = !isActive;
          if (field.dataset.requiredWhenActive === "true") {
            field.required = isActive;
          }
        });
      });
    }

    paymentInputs.forEach((input) => input.addEventListener("change", updatePaymentDetails));
    updatePaymentDetails();
  });
})();
