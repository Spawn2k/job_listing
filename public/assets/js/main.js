(() => {
	// === DOM & VARS =======
	const DOM = {};
	DOM.btnEl = document.querySelector(".btn");
	DOM.bodyEl = document.querySelector("body");
	// === INIT =============
	const init = () => {
		DOM.btnEl.addEventListener("click", onClickBtn);
		getData().catch((e) => console.log(e));
	};

	// === EVENTHANDLER =====

	const onClickBtn = () => {
		// const getData = async () => {
		// 	const response = await fetch("sandbox/posts", {
		// 		method: "GET",
		// 		headers: {
		// 			"Content-Type": "application/json",
		// 		},
		// 	});
		// 	if (response.status === 200) {
		// 		const peaple = await response.json();
		// 		return peaple;
		// 	}
		// };
		//
		// getData().catch((error) => console.log);
	};

	// === XHR/FETCH ========

	const getData = async () => {
		const response = await fetch("sandbox/posts", {
			method: "GET",
			headers: {
				"Content-Type": "application/json",
			},
		});
		if (response.status === 200) {
			const listings = await response.json();

			for (let i = 0; i < listings.length; i++) {
				createEl(listings[i].title);
			}
            jobs = listings;
			return listings;
		}
	};

	// === FUNCTIONS ========

	const createEl = (string) => {
		const pel = document.createElement("p");
		pel.innerText = string;
		DOM.bodyEl.appendChild(pel);
	};

	init();
})();
