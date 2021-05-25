import view from '../views/posts.html';

const getPost = async () => {
	const response = await fetch('https://jsonplaceholder.typicode.com/posts');
	return await response.json();
};

export default async () => {
	const divElement = document.createElement('div');
	divElement.innerHTML = view;

	const postsElement = divElement.querySelector('#posts');
	let totalPost = divElement.querySelector('#total');

	const posts = await getPost();
	totalPost.innerHTML = posts.length;

	posts.forEach((post) => {
		postsElement.innerHTML += `
    <li class="list-group-item bg-secondary bg-dark">
      <h5>${post.title}</h5>
      <p>${post.body}</p>
    
    </li>
    `;
	});

	return divElement;
};
