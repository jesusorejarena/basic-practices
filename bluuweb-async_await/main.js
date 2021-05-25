// Fetch Normal

const getNombre = (idPost) => {
	fetch(`https://jsonplaceholder.typicode.com/posts/${idPost}`)
		.then((res) => {
			return res.json();
		})
		.then((post) => {
			console.log(post.userId);
			fetch(`https://jsonplaceholder.typicode.com/users/${post.userId}`)
				.then((res) => {
					return res.json();
				})
				.then((user) => {
					console.log(user.name + ' Fetch Normal');
					console.log('------------------------------------');
				});
		});
};

getNombre(80);

// Fetch con Async & Await

const getNombreAsync = async (idPost) => {
	try {
		const resPost = await fetch(`https://jsonplaceholder.typicode.com/posts/${idPost}`);
		const post = await resPost.json();

		const resUser = await fetch(`https://jsonplaceholder.typicode.com/users/${post.userId}`);
		const user = await resUser.json();

		console.log(user.name + ' Fetch con Async & Await');
		console.log('------------------------------------');
	} catch (error) {
		console.log(error);
	}
};

getNombreAsync(80);

// Fetch con Axios Async & Await

const getNombreAxios = async (idPost) => {
	try {
		const resPost = await axios(`https://jsonplaceholder.typicode.com/posts/${idPost}`);

		const resUser = await axios(`https://jsonplaceholder.typicode.com/users/${resPost.data.userId}`);

		console.log(resUser.data.name + ' Fetch con Axios Async & Await');
		console.log('------------------------------------');
	} catch (error) {
		console.log(error);
	}
};

getNombreAxios(80);
