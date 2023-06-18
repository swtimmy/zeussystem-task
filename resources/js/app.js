import "./bootstrap";

// livewire receive
window.livewire.on("commentAdded", (res) => {
    alert(res.message);
});

window.livewire.on("alert", (res) => {
    alert(res.message);
});
