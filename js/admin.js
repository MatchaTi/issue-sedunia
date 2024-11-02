const contentUsers = document.querySelector(".content-users");
const contentPosts = document.querySelector(".content-posts");
const contentComments = document.querySelector(".content-comments");
const btnUsers = document.querySelector(".btn-users");
const btnPosts = document.querySelector(".btn-posts");
const btnComments = document.querySelector(".btn-comments");

const contents = [
  { content: contentUsers, button: btnUsers },
  { content: contentPosts, button: btnPosts },
  { content: contentComments, button: btnComments },
];

contents.forEach(({ content, button }) => {
  button.addEventListener("click", () => {
    contents.forEach(({ content }) => content.classList.add("hidden"));
    content.classList.remove("hidden");
  });
});
