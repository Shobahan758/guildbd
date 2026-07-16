document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('[data-password-toggle]').forEach((button) => {
    const input = document.getElementById(button.dataset.passwordToggle);

    if (!input) return;

    button.addEventListener('click', () => {
      const willShow = input.type === 'password';
      input.type = willShow ? 'text' : 'password';
      button.setAttribute('aria-pressed', String(willShow));
      button.setAttribute('aria-label', willShow ? 'Hide password' : 'Show password');
      input.focus({ preventScroll: true });
    });
  });
});
