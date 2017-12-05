'use strict';
function Select2MyResultFormat (repo) {
    console.log(JSON.stringify(repo));
    if (repo.loading) {
        return repo.text;
    }

    var markup = "<div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository__avatar'>"+ repo.avatar +"</div>" +
        "<div class='select2-result-repository__meta'>" +
        "<div class='select2-result-repository__title'>" + repo.nickname + "</div>";

    markup += "<div class='select2-result-repository__statistics'>" +
        "<div class='select2-result-repository__forks'><i class='fa fa-flash'></i> Forks</div>" +
        "<div class='select2-result-repository__stargazers'><i class='fa fa-star'></i> Stars</div>" +
        "<div class='select2-result-repository__watchers'><i class='fa fa-eye'></i> Watchers</div>" +
    "</div>" +
    "</div></div>";

    return markup;
}

function formatRepoSelection (repo) {
    return repo.full_name || repo.text;
}