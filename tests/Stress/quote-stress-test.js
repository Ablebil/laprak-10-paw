import http from "k6/http";
import { check, sleep } from "k6";

export const options = {
    stages: [
        { duration: "30s", target: 10 },
        { duration: "30s", target: 20 },
        { duration: "10s", target: 0 },
    ],
};

const BASE_URL = __ENV.BASE_URL;

export default function () {
    let loginPage = http.get(`${BASE_URL}/login`);
    let csrfToken = loginPage
        .html()
        .find('input[name="_token"]')
        .first()
        .attr("value");

    let loginRes = http.post(`${BASE_URL}/login`, {
        _token: csrfToken,
        email: "admin@test.com",
        password: "password123",
    });

    check(loginRes, {
        "Login successful": (r) => r.status === 200 || r.status === 302,
    });

    let readRes = http.get(`${BASE_URL}/quotes`);
    check(readRes, { "Read successful": (r) => r.status === 200 });

    let newCsrf = readRes
        .html()
        .find('input[name="_token"]')
        .first()
        .attr("value");

    let createRes = http.post(`${BASE_URL}/quotes`, {
        _token: newCsrf,
        quote_text: `Load testing quote ID-${__VU}-${__ITER}`,
        author: "Load Tester",
    });

    check(createRes, {
        "Create successful": (r) => r.status === 200 || r.status === 302,
    });

    let freshPage = http.get(`${BASE_URL}/quotes`);
    let quoteActionUrl = freshPage
        .html()
        .find('form[action^="/quotes/"]')
        .last()
        .attr("action");
    let freshCsrf = freshPage
        .html()
        .find('input[name="_token"]')
        .first()
        .attr("value");

    if (quoteActionUrl) {
        let updateRes = http.post(`${BASE_URL}${quoteActionUrl}`, {
            _token: freshCsrf,
            _method: "PUT",
            quote_text: "Updated load testing quote.",
            author: "Tester Updated",
        });

        check(updateRes, {
            "Update successful": (r) => r.status === 200 || r.status === 302,
        });

        let deleteRes = http.post(`${BASE_URL}${quoteActionUrl}`, {
            _token: freshCsrf,
            _method: "DELETE",
        });

        check(deleteRes, {
            "Delete successful": (r) => r.status === 200 || r.status === 302,
        });
    }

    sleep(1);
}
