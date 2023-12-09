<style>
    body {
  background-color: #2F3242;
}
svg {
  position: absolute;
  top: 50%;
  left: 50%;
  margin-top: -250px;
  margin-left: -400px;
}
.message-box {
  height: 200px;
  width: 380px;
  position: absolute;
  top: 50%;
  left: 50%;
  margin-top: -100px;
  margin-left: 50px;
  color: #FFF;
  font-family: Roboto;
  font-weight: 300;
}
.message-box h1 {
  font-size: 60px;
  line-height: 46px;
  margin-bottom: 40px;
}
.buttons-con .action-link-wrap {
  margin-top: 40px;
}
.buttons-con .action-link-wrap a {
  background: #f49848;
  padding: 8px 25px;
  border-radius: 4px;
  color: #FFF;
  font-weight: bold;
  font-size: 14px;
  transition: all 0.3s linear;
  cursor: pointer;
  text-decoration: none;
  margin-right: 10px
}
.buttons-con .action-link-wrap a:hover {
  background: #5A5C6C;
  color: #fff;
}

#Polygon-1 , #Polygon-2 , #Polygon-3 , #Polygon-4 , #Polygon-4, #Polygon-5 {
  animation: float 1s infinite ease-in-out alternate;
}
#Polygon-2 {
  animation-delay: .2s;
}
#Polygon-3 {
  animation-delay: .4s;
}
#Polygon-4 {
  animation-delay: .6s;
}
#Polygon-5 {
  animation-delay: .8s;
}

@keyframes float {
	100% {
    transform: translateY(20px);
  }
}
@media (max-width: 450px) {
  svg {
    position: absolute;
    top: 50%;
    left: 50%;
    margin-top: -250px;
    margin-left: -190px;
  }
  .message-box {
    top: 50%;
    left: 50%;
    margin-top: -100px;
    margin-left: -190px;
    text-align: center;
  }
}
</style>
<svg width="380px" height="500px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 501.333 501.333"
 xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0">
    </g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <rect y="5.333" style="fill:#FEC656;" width="114.133" height="490.667"></rect> <rect x="160" y="5.333" style="fill:#60C3AB;" width="114.133" height="490.667"></rect> <polygon style="fill:#BE85BA;" points="501.333,484.267 388.267,501.333 309.333,17.067 422.4,0 "></polygon> <rect x="28.8" y="242.133" style="fill:#F6F7F8;" width="55.467" height="183.467"></rect> <rect y="106.667" style="fill:#EF9F2C;" width="114.133" height="22.4"></rect> <rect x="160" y="106.667" style="fill:#47A58D;" width="114.133" height="22.4"></rect> <rect x="188.8" y="242.133" style="fill:#F6F7F8;" width="55.467" height="180.267"></rect> <rect x="326.397" y="107.765" transform="matrix(-0.9891 0.1473 -0.1473 -0.9891 780.2683 180.1478)" style="fill:#99629C;" width="114.134" height="22.4"></rect> <rect x="390.37" y="241.151" transform="matrix(-0.9869 0.1615 -0.1615 -0.9869 884.2212 590.7031)" style="fill:#F6F7F8;" width="55.468" height="180.272"></rect> </g></svg>
<div class="message-box">
  <h1>404</h1>
  <p>Page not found</p>
  <div class="buttons-con">
    <div class="action-link-wrap">
      {{-- <a onclick="history.back(-1)" class="link-button link-back-button">Go Back</a> --}}
      <a href="{{ url()->previous() }}" class="link-button link-back-button">Go Back</a>
      {{-- <a href="{{ route('home') }}" class="link-button">Go to Home Page</a> --}}
    </div>
  </div>
</div>
