document.querySelector("#vote").addEventListener('click', voteFor);

function voteFor(event) {
    event.preventDefault();
    let votelistLink = event.currentTarget;
    let link = votelistLink.href;
// Send an HTTP request with fetch to the URI defined in the href
    fetch(link)
        // Extract the JSON from the response
        .then(res => res.json())
        // Then update the icon
        .then(function(res) {
            let votelistIcon = votelistLink.firstElementChild;
            if (res.hasVotedFor) {
                votelistIcon.classList.remove('far'); // Remove the .far (empty heart) from classes in <i> element
                votelistIcon.classList.add('fas'); // Add the .fas (full heart) from classes in <i> element
            } else {
                votelistIcon.classList.remove('fas'); // Remove the .fas (full heart) from classes in <i> element
                votelistIcon.classList.add('far'); // Add the .far (empty heart) from classes in <i> element
            }
        });
}
