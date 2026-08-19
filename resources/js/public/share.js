(function (){
    const app = {

        shareBtn : document.querySelector('.share-btn'),
        currentUrl : document.URL,

        init() {
            this.addCopyMessage(this.shareBtn, this.currentUrl);
        },

        addCopyMessage(shareBtn, currentUrl){
            shareBtn.addEventListener("click", async (event) => {
                event.preventDefault();
               //console.log("hello");      Test to see if works
                await navigator.clipboard.writeText(currentUrl)
                    .then(() => {
                        alert('Copied to clipboard!');
                    })
            });
        }
    }
    app.init();
})();


// sources:

// https://medium.com/@a1guy/copy-text-to-clipboard-in-javascript-no-libraries-required-29062a435eb0

// https://stackoverflow.com/questions/400212/how-do-i-copy-to-the-clipboard-in-javascript

// https://www.w3schools.com/howto/howto_js_copy_clipboard.asp
