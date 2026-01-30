/* =======================
   AUDIO
======================= */

var audio = document.getElementById("audioPlayer");

var btnAudioPlay = document.getElementById("audioPlay");
var btnAudioStop = document.getElementById("audioStop");
var btnAudioAtras = document.getElementById("audioAtras");
var btnAudioAdelante = document.getElementById("audioAdelante");
var btnAudioReiniciar = document.getElementById("audioReiniciar");
var btnAudioPrev = document.getElementById("audioPrev");
var btnAudioNext = document.getElementById("audioNext");
var audioList = document.getElementById("audioList");
var lblPistaActual = document.getElementById("currentTrack");

var audioTracks = [
	{ src: "img/audio/LDC.mp3", title: "Video de Linea de Cal" },
	{ src: "img/audio/Ander Herrera.mp3", title: "Entrevista a Ander Herrera" },
	{ src: "img/audio/Jagoba Arrasate.mp3", title: "Entrevista a Jagoba Arrasate" }
];

var audioIndex = 0;

function setAudioSrc(src) {
	// encodeURI arregla espacios y caracteres raros
	audio.src = encodeURI(src);
	audio.load();
}

function cargarPista() {
	setAudioSrc(audioTracks[audioIndex].src);
	lblPistaActual.innerText = audioTracks[audioIndex].title;
	audioList.selectedIndex = audioIndex;
}

function playPauseAudio() {
	if (audio.paused) {
		audio.play();
		btnAudioPlay.innerText = "Pause";
	} else {
		audio.pause();
		btnAudioPlay.innerText = "Play";
	}
}

function stopAudio() {
	audio.pause();
	audio.currentTime = 0;
	btnAudioPlay.innerText = "Play";
}

function moverAudio(segundos) {
	audio.currentTime = Math.max(0, audio.currentTime + segundos);
}

function reiniciarAudio() {
	audio.pause();
	audio.currentTime = 0;
	btnAudioPlay.innerText = "Play";
}

function prevAudio() {
	audioIndex--;
	if (audioIndex < 0) audioIndex = audioTracks.length - 1;
	cargarPista();
	audio.play();
	btnAudioPlay.innerText = "Pause";
}

function nextAudio() {
	audioIndex++;
	if (audioIndex >= audioTracks.length) audioIndex = 0;
	cargarPista();
	audio.play();
	btnAudioPlay.innerText = "Pause";
}

btnAudioPlay.onclick = playPauseAudio;
btnAudioStop.onclick = stopAudio;
btnAudioAtras.onclick = function () { moverAudio(-10); };
btnAudioAdelante.onclick = function () { moverAudio(10); };
btnAudioReiniciar.onclick = reiniciarAudio;
btnAudioPrev.onclick = prevAudio;
btnAudioNext.onclick = nextAudio;

audioList.onchange = function () {
	audioIndex = audioList.selectedIndex;
	cargarPista();
	audio.play();
	btnAudioPlay.innerText = "Pause";
};

audio.onended = function () {
	btnAudioPlay.innerText = "Play";
};

cargarPista();


/* =======================
   VIDEO
======================= */

var video = document.getElementById("videoPlayer");

var btnVideoPlay = document.getElementById("videoPlay");
var btnVideoStop = document.getElementById("videoStop");
var btnVideoMute = document.getElementById("videoMute");
var btnVideoVolMas = document.getElementById("videoVolMas");
var btnVideoVolMenos = document.getElementById("videoVolMenos");
var btnVideoAtras = document.getElementById("videoAtras");
var btnVideoAdelante = document.getElementById("videoAdelante");
var btnVideoPrev = document.getElementById("videoPrev");
var btnVideoNext = document.getElementById("videoNext");
var videoList = document.getElementById("videoList");

var videoTracks = [
	{ src: "img/audio/PDQ.mp4", title: "Video de La Pizarra de Quintana" },
	{ src: "img/audio/Kolderiu analisis.mp4", title: "Kolderiu analisis" },
	{ src: "img/audio/Resumen Cultural Athletic.mp4", title: "Resumen Cultural Athletic" }
];

var videoIndex = 0;

function setVideoSrc(src) {
	video.src = encodeURI(src);
	video.load();
}

function cargarVideo() {
	setVideoSrc(videoTracks[videoIndex].src);
	videoList.selectedIndex = videoIndex;
}

function playPauseVideo() {
	if (video.paused) {
		video.play();
		btnVideoPlay.innerText = "Pause";
	} else {
		video.pause();
		btnVideoPlay.innerText = "Play";
	}
}

function stopVideo() {
	video.pause();
	video.currentTime = 0;
	btnVideoPlay.innerText = "Play";
}

function moverVideo(segundos) {
	video.currentTime = Math.max(0, video.currentTime + segundos);
}

function prevVideo() {
	videoIndex--;
	if (videoIndex < 0) videoIndex = videoTracks.length - 1;
	cargarVideo();
	video.play();
	btnVideoPlay.innerText = "Pause";
}

function nextVideo() {
	videoIndex++;
	if (videoIndex >= videoTracks.length) videoIndex = 0;
	cargarVideo();
	video.play();
	btnVideoPlay.innerText = "Pause";
}

btnVideoPlay.onclick = playPauseVideo;
btnVideoStop.onclick = stopVideo;

btnVideoMute.onclick = function () {
	video.muted = !video.muted;
	btnVideoMute.innerText = video.muted ? "Unmute" : "Mute";
};

btnVideoVolMas.onclick = function () { video.volume = Math.min(1, video.volume + 0.1); };
btnVideoVolMenos.onclick = function () { video.volume = Math.max(0, video.volume - 0.1); };

btnVideoAtras.onclick = function () { moverVideo(-10); };
btnVideoAdelante.onclick = function () { moverVideo(10); };

btnVideoPrev.onclick = prevVideo;
btnVideoNext.onclick = nextVideo;

videoList.onchange = function () {
	videoIndex = videoList.selectedIndex;
	cargarVideo();
	video.play();
	btnVideoPlay.innerText = "Pause";
};

video.onended = function () {
	btnVideoPlay.innerText = "Play";
};

cargarVideo();
