export function showToast(message) {
  toast.innerHTML = message;
  setTimeout(() => {
    toast.classList.add("show");
    setTimeout(() => {
      toast.classList.remove("show");
    }, 3000);
  }, 100);
}
