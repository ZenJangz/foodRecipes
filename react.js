/**
 * v0 by Vercel.
 * @see https://v0.dev/t/YqfCdOdOrPt
 */
import { Button } from "@/components/ui/button"
import { Slider } from "@/components/ui/slider"

export default function Component() {
  return (
    <div className="flex flex-col gap-4 p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md max-w-md mx-auto">
      <div className="flex items-center justify-between">
        <div>
          <h2 className="text-lg font-semibold">Track Title</h2>
          <p className="text-sm text-gray-500 dark:text-gray-400">Artist Name</p>
        </div>
        <div className="flex items-center gap-2">
          <Button size="icon" variant="ghost">
            <Volume2Icon className="h-4 w-4" />
            <span className="sr-only">Volume</span>
          </Button>
          <Slider className="w-16" />
        </div>
      </div>
      <div className="flex items-center gap-4">
        <Button size="icon" variant="ghost">
          <SkipBackIcon className="h-4 w-4" />
          <span className="sr-only">Previous</span>
        </Button>
        <Button size="icon" variant="ghost">
          <PlayIcon className="h-4 w-4" />
          <span className="sr-only">Play</span>
        </Button>
        <Button size="icon" variant="ghost">
          <PauseIcon className="h-4 w-4" />
          <span className="sr-only">Pause</span>
        </Button>
        <Button size="icon" variant="ghost">
          <SkipForwardIcon className="h-4 w-4" />
          <span className="sr-only">Next</span>
        </Button>
      </div>
      <div className="relative h-2 bg-gray-200 dark:bg-gray-700 rounded-full">
        <div className="absolute left-0 h-2 bg-blue-500 rounded-full w-1/3" />
      </div>
    </div>
  )
}

function PauseIcon(props) {
  return (
    <svg
      {...props}
      xmlns="http://www.w3.org/2000/svg"
      width="24"
      height="24"
      viewBox="0 0 24 24"
      fill="none"
      stroke="currentColor"
      strokeWidth="2"
      strokeLinecap="round"
      strokeLinejoin="round"
    >
      <rect width="4" height="16" x="6" y="4" />
      <rect width="4" height="16" x="14" y="4" />
    </svg>
  )
}


function PlayIcon(props) {
  return (
    <svg
      {...props}
      xmlns="http://www.w3.org/2000/svg"
      width="24"
      height="24"
      viewBox="0 0 24 24"
      fill="none"
      stroke="currentColor"
      strokeWidth="2"
      strokeLinecap="round"
      strokeLinejoin="round"
    >
      <polygon points="5 3 19 12 5 21 5 3" />
    </svg>
  )
}


function SkipBackIcon(props) {
  return (
    <svg
      {...props}
      xmlns="http://www.w3.org/2000/svg"
      width="24"
      height="24"
      viewBox="0 0 24 24"
      fill="none"
      stroke="currentColor"
      strokeWidth="2"
      strokeLinecap="round"
      strokeLinejoin="round"
    >
      <polygon points="19 20 9 12 19 4 19 20" />
      <line x1="5" x2="5" y1="19" y2="5" />
    </svg>
  )
}


function SkipForwardIcon(props) {
  return (
    <svg
      {...props}
      xmlns="http://www.w3.org/2000/svg"
      width="24"
      height="24"
      viewBox="0 0 24 24"
      fill="none"
      stroke="currentColor"
      strokeWidth="2"
      strokeLinecap="round"
      strokeLinejoin="round"
    >
      <polygon points="5 4 15 12 5 20 5 4" />
      <line x1="19" x2="19" y1="5" y2="19" />
    </svg>
  )
}


function Volume2Icon(props) {
  return (
    <svg
      {...props}
      xmlns="http://www.w3.org/2000/svg"
      width="24"
      height="24"
      viewBox="0 0 24 24"
      fill="none"
      stroke="currentColor"
      strokeWidth="2"
      strokeLinecap="round"
      strokeLinejoin="round"
    >
      <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5" />
      <path d="M15.54 8.46a5 5 0 0 1 0 7.07" />
      <path d="M19.07 4.93a10 10 0 0 1 0 14.14" />
    </svg>
  )
}
