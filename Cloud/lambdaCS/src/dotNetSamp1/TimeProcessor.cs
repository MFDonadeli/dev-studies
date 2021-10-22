using System;
using System.Collections.Generic;
using System.Text;

namespace dotNetSamp1
{
    public class TimeProcessor : ITimeProcessor
    {
        public DateTime CurrentTimeUTC()
        {
            return DateTime.UtcNow;
        }
    }
}