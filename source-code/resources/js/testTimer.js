
export const countDown = () => {
  const endTime = new Date("Jul 25, 2023 16:37:52").getTime();

  const timer = setInterval(() => {
  const currentTime = new Date().getTime()
  const timeLeft = endTime - currentTime

  return {
    days: Math.floor(timeleft / (1000 * 60 * 60 * 24)),
    hours: Math.floor((timeleft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)),
    minutes: Math.floor((timeleft % (1000 * 60 * 60)) / (1000 * 60)),
    seconds: Math.floor((timeleft % (1000 * 60)) / 1000)
  }

  if (timeLeft <= 0) {
    clearInterval(timer)
    return 'time up'
  }
  }, 1000)
}




