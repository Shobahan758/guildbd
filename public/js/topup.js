(() => {
  "use strict";

  document.addEventListener("DOMContentLoaded", () => {
    const paymentInputs = document.querySelectorAll('input[name="payment"]');
    const detailPanels = document.querySelectorAll("[data-payment-panel]");
    const packageInputs = document.querySelectorAll('input[name="package"]');
    const summaryTotal = document.querySelector("#summary-total");

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
    packageInputs.forEach((input) => {
      input.addEventListener("change", () => {
        if (summaryTotal) summaryTotal.textContent = `৳${input.dataset.price}`;
      });
    });

    updatePaymentDetails();

    const selectedPackage = document.querySelector('input[name="package"]:checked');
    if (selectedPackage && summaryTotal) {
      summaryTotal.textContent = `৳${selectedPackage.dataset.price}`;
    }
  });
})();
